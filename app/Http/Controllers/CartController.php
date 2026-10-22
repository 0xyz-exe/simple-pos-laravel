<?php
namespace App\Http\Controllers;
use App\Models\{Product, Transaction, TransactionItem};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->with('category')->get();
        $cart = session('cart', []);
        return view('cart.index', compact('products', 'cart'));
    }
    
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session('cart', []);
        $qty = (int)$request->quantity;
        
        if (isset($cart[$product->id])) $cart[$product->id]['quantity'] += $qty;
        else $cart[$product->id] = ['product' => $product, 'quantity' => $qty];
        
        session(['cart' => $cart]);
        return back()->with('success', 'Added to cart.');
    }
    
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Removed from cart.');
    }
    
    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return back()->with('error', 'Cart is empty.');
        
        DB::beginTransaction();
        try {
            $subtotal = 0;
            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->find($item['product']->id);
                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return back()->with('error', "Insufficient stock for {$product->name}");
                }
                $subtotal += $product->price * $item['quantity'];
            }
            
            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;
            
            $transaction = Transaction::create([
                'transaction_code' => Transaction::generateCode(),
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => 0,
                'total' => $total,
            ]);
            
            foreach ($cart as $item) {
                $product = Product::find($item['product']->id);
                $product->decrement('stock', $item['quantity']);
                
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }
            
            DB::commit();
            session()->forget('cart');
            return redirect()->route('transactions.show', $transaction)->with('success', 'Transaction completed.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }
    }
}
