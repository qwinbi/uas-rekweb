<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $transactions = $user->transactions()->with('items.product')->latest()->get();
        
        $data = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'invoice_number' => $transaction->invoice_number,
                'total' => $transaction->total,
                'formatted_total' => $transaction->formatted_total,
                'payment_method' => $transaction->payment_method,
                'status' => $transaction->status,
                'payment_proof' => $transaction->payment_proof_url,
                'items_count' => $transaction->items->count(),
                'created_at' => $transaction->formatted_date,
                'items' => $transaction->items->map(function ($item) {
                    return [
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->subtotal,
                        'formatted_subtotal' => 'Rp ' . number_format($item->subtotal, 0, ',', '.'),
                    ];
                }),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function show(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', $request->user()->id)
            ->with('items.product')
            ->find($id);

        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $transaction->id,
                'invoice_number' => $transaction->invoice_number,
                'total' => $transaction->total,
                'formatted_total' => $transaction->formatted_total,
                'payment_method' => $transaction->payment_method,
                'status' => $transaction->status,
                'payment_proof' => $transaction->payment_proof_url,
                'created_at' => $transaction->formatted_date,
                'user' => [
                    'name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                ],
                'items' => $transaction->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'product_photo' => $item->product->photo_url,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->subtotal,
                        'formatted_price' => 'Rp ' . number_format($item->price, 0, ',', '.'),
                        'formatted_subtotal' => 'Rp ' . number_format($item->subtotal, 0, ',', '.'),
                    ];
                }),
            ]
        ]);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_proof' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction = Transaction::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ], 404);
        }

        if ($transaction->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot upload payment proof for this transaction status'
            ], 400);
        }

        // Upload file
        $file = $request->file('payment_proof');
        $filename = 'proof_' . $transaction->invoice_number . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/payments', $filename);

        // Update transaction
        $transaction->payment_proof = $filename;
        $transaction->status = 'waiting_payment';
        $transaction->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment proof uploaded successfully',
            'data' => [
                'payment_proof_url' => asset('storage/payments/' . $filename),
                'status' => $transaction->status,
            ]
        ]);
    }
}