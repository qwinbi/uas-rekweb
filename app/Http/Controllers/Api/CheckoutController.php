<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:virtual_account,qris',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your cart is empty'
            ], 400);
        }

        // Validate stock
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Insufficient stock for ' . $item->product->name . '. Available: ' . $item->product->stock
                ], 400);
            }
        }

        DB::beginTransaction();

        try {
            // Calculate total
            $total = $cartItems->sum(function ($cart) {
                return $cart->quantity * $cart->product->price;
            });

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'invoice_number' => Transaction::generateInvoiceNumber(),
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Handle payment proof upload
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = 'proof_' . $transaction->invoice_number . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/payments', $filename);
                $transaction->payment_proof = $filename;
                $transaction->status = 'waiting_payment';
                $transaction->save();
            }

            // Create transaction items and update stock
            foreach ($cartItems as $cart) {
                TransactionItem::createFromCart($transaction->id, $cart);
                $cart->product->reduceStock($cart->quantity);
            }

            // Clear cart
            $user->carts()->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Checkout completed successfully',
                'data' => [
                    'transaction_id' => $transaction->id,
                    'invoice_number' => $transaction->invoice_number,
                    'total' => $transaction->total,
                    'formatted_total' => $transaction->formatted_total,
                    'payment_method' => $transaction->payment_method,
                    'status' => $transaction->status,
                    'items_count' => $transaction->items()->count(),
                    'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                ]
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Checkout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getPaymentInfo()
    {
        $qrisImage = Setting::get('qris_image');
        $virtualAccount = Setting::get('virtual_account', '1234567890');

        return response()->json([
            'status' => 'success',
            'data' => [
                'qris_image' => $qrisImage ? asset('storage/qris/' . $qrisImage) : null,
                'virtual_account' => $virtualAccount,
                'bank_name' => 'BUNNY BANK',
                'account_name' => 'BUNNYPOPS STORE',
            ]
        ]);
    }
}