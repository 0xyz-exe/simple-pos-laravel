<?php
namespace App\Http\Controllers;
use App\Models\{Product, Category};
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->filled('category')) $query->where('category_id', $request->category);
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%{$s}%")->orWhere('sku', 'like', "%{$s}%"));
        }
        $products = $query->paginate(20);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }
    
    public function create() { return view('products.create', ['categories' => Category::all()]); }
    
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created.');
    }
    
    public function edit(Product $product) { return view('products.edit', compact('product')); }
    
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
