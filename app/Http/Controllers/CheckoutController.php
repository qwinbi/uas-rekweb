<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        $qrisImage = Setting::getValue('qris_image');
        $virtualAccount = Setting::getValue('virtual_account');

        return view('checkout', compact('cartItems', 'total', 'qrisImage', 'virtualAccount'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:virtual_account,qris',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        $cartItems = Auth::user()->carts()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Check stock
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->qty) {
                return back()->with('error', 'Insufficient stock for ' . $item->product->name);
            }
        }

        DB::beginTransaction();

        try {
            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->qty;
            });

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'waiting_approval',
            ]);

            // Handle payment proof upload
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = 'proof' . $transaction->id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/payments', $filename);
                $transaction->payment_proof = $filename;
                $transaction->save();
            }

            // Create transaction items and update stock
            foreach ($cartItems as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->product->price,
                ]);

                // Update product stock
                $item->product->decrement('stock', $item->qty);
            }

            // Clear cart
            Auth::user()->carts()->delete();

            DB::commit();

            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Checkout successful! Your order is being processed.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }
}