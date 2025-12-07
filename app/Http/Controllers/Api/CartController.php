<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $cartItems = $user->carts()->with('product')->get();
        
        $items = $cartItems->map(function ($cart) {
            return [
                'id' => $cart->id,
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->name,
                'product_price' => $cart->product->price,
                'product_photo' => $cart->product->photo_url,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
                'formatted_subtotal' => $cart->formatted_subtotal,
            ];
        });

        $total = $cartItems->sum('subtotal');

        return response()->json([
            'status' => 'success',
            'data' => [
                'items' => $items,
                'total' => $total,
                'formatted_total' => 'Rp ' . number_format($total, 0, ',', '.'),
                'item_count' => $cartItems->count(),
            ]
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::find($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient stock. Available: ' . $product->stock
            ], 400);
        }

        $user = $request->user();
        
        // Check if product already in cart
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($product->stock < $newQuantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Insufficient stock for additional quantity'
                ], 400);
            }
            
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart',
            'data' => [
                'cart_id' => $cartItem->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->subtotal,
                'product_name' => $product->name,
                'product_price' => $product->price,
            ]
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->with('product')
            ->first();

        if (!$cartItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }

        if ($cartItem->product->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient stock. Available: ' . $cartItem->product->stock
            ], 400);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully',
            'data' => [
                'cart_id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->subtotal,
            ]
        ]);
    }

    public function remove($id)
    {
        $cartItem = Cart::where('user_id', request()->user()->id)
            ->where('id', $id)
            ->first();

        if (!$cartItem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart'
        ]);
    }

    public function clear()
    {
        $user = request()->user();
        $user->carts()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared successfully'
        ]);
    }
}