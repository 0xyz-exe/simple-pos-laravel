<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('items.product')->orderBy('created_at', 'desc')->paginate(20);
        $todaySales = Transaction::whereDate('created_at', today())->sum('total');
        return view('transactions.index', compact('transactions', 'todaySales'));
    }
    
    public function show(Transaction $transaction)
    {
        $transaction->load('items.product', 'user');
        return view('transactions.show', compact('transaction'));
    }
}
