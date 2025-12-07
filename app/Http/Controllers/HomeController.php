<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get();
        return view('home', compact('products'));
    }

    public function shop()
    {
        $products = Product::latest()->get();
        return view('shop', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        return view('product-detail', compact('product', 'relatedProducts'));
    }

    public function about()
    {
        $aboutImage = Setting::getValue('about_image');
        $aboutDescription = Setting::getValue('about_description');
        
        return view('about', compact('aboutImage', 'aboutDescription'));
    }
}