<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        $newTransactions = Transaction::where('status', 'waiting_approval')->count();
        
        return view('admin.transactions.index', compact('transactions', 'newTransactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:waiting_approval,paid,cancelled',
        ]);

        $transaction->update(['status' => $request->status]);

        return back()->with('success', 'Transaction status updated');
    }
}