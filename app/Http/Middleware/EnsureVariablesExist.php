<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EnsureVariablesExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Share default variables with all views
        $this->shareDefaultVariables();
        
        $response = $next($request);
        
        // You can also modify response after it's generated
        return $response;
    }
    
    /**
     * Share default variables with views
     */
    private function shareDefaultVariables()
    {
        // Share default data for home page
        if (request()->route()->getName() == 'home') {
            $defaultProducts = [
                (object)[
                    'id' => 1,
                    'name' => 'Produk Contoh 1',
                    'description' => 'Deskripsi produk contoh',
                    'price' => 100000,
                    'discount' => 10,
                    'image' => null,
                    'rating' => 4.5,
                ],
                // Add more default products...
            ];
            
            View::share('featuredProducts', collect($defaultProducts));
            View::share('categories', collect([]));
            View::share('testimonials', collect([]));
        }
    }
}