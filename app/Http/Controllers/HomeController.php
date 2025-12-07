<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        try {
            // Featured Products - produk dengan diskon atau rating tinggi
            $featuredProducts = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->where('discount', '>', 0)
                          ->orWhere('rating', '>=', 4);
                })
                ->orderBy('discount', 'desc')
                ->limit(8)
                ->get();
        } catch (\Exception $e) {
            // Fallback jika database error
            $featuredProducts = $this->getDummyProducts();
        }

        try {
            // Categories with product count
            $categories = Category::withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->where('is_active', true)
            ->limit(6)
            ->get();
        } catch (\Exception $e) {
            // Fallback categories
            $categories = $this->getDummyCategories();
        }

        try {
            // Testimonials (reviews dengan rating tinggi)
            $testimonials = Review::with('user')
                ->where('rating', '>=', 4)
                ->where('is_approved', true)
                ->latest()
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            // Fallback testimonials
            $testimonials = $this->getDummyTestimonials();
        }

        return view('home', compact(
            'featuredProducts',
            'categories',
            'testimonials'
        ));
    }

    /**
     * Get dummy products for fallback
     */
    private function getDummyProducts()
    {
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Kemeja Flanel Premium',
                'description' => 'Kemeja flanel dengan bahan premium, nyaman dipakai sehari-hari maupun acara formal.',
                'price' => 299000,
                'discount' => 15,
                'image' => null,
                'rating' => 4.5,
                'reviews_count' => 24,
                'category' => (object)['name' => 'Fashion'],
            ],
            (object)[
                'id' => 2,
                'name' => 'Smartphone X Pro',
                'description' => 'Smartphone flagship dengan kamera 108MP dan baterai 5000mAh.',
                'price' => 8999000,
                'discount' => 10,
                'image' => null,
                'rating' => 4.8,
                'reviews_count' => 156,
                'category' => (object)['name' => 'Elektronik'],
            ],
            (object)[
                'id' => 3,
                'name' => 'Lipstick Matte Collection',
                'description' => 'Lipstick matte dengan warna tahan lama dan tidak mudah luntur.',
                'price' => 149000,
                'discount' => 20,
                'image' => null,
                'rating' => 4.3,
                'reviews_count' => 67,
                'category' => (object)['name' => 'Kecantikan'],
            ],
            (object)[
                'id' => 4,
                'name' => 'Blender Multifungsi',
                'description' => 'Blender dengan 8 kecepatan dan 4 fungsi untuk kebutuhan dapur Anda.',
                'price' => 499000,
                'discount' => 0,
                'image' => null,
                'rating' => 4.6,
                'reviews_count' => 45,
                'category' => (object)['name' => 'Rumah Tangga'],
            ],
            (object)[
                'id' => 5,
                'name' => 'Sepatu Lari Premium',
                'description' => 'Sepatu lari dengan teknologi cushioning terbaik untuk kenyamanan maksimal.',
                'price' => 799000,
                'discount' => 25,
                'image' => null,
                'rating' => 4.7,
                'reviews_count' => 89,
                'category' => (object)['name' => 'Olahraga'],
            ],
            (object)[
                'id' => 6,
                'name' => 'Set Lego Creator',
                'description' => 'Set Lego dengan 1500 piece untuk mengasah kreativitas.',
                'price' => 1299000,
                'discount' => 15,
                'image' => null,
                'rating' => 4.9,
                'reviews_count' => 123,
                'category' => (object)['name' => 'Mainan'],
            ],
            (object)[
                'id' => 7,
                'name' => 'Jam Tangan Smart',
                'description' => 'Smartwatch dengan fitur kesehatan dan notifikasi smartphone.',
                'price' => 1599000,
                'discount' => 12,
                'image' => null,
                'rating' => 4.4,
                'reviews_count' => 78,
                'category' => (object)['name' => 'Elektronik'],
            ],
            (object)[
                'id' => 8,
                'name' => 'Tas Ransel Travel',
                'description' => 'Tas ransel anti air dengan banyak kompartemen untuk traveling.',
                'price' => 449000,
                'discount' => 18,
                'image' => null,
                'rating' => 4.6,
                'reviews_count' => 56,
                'category' => (object)['name' => 'Fashion'],
            ],
        ]);
    }

    /**
     * Get dummy categories for fallback
     */
    private function getDummyCategories()
    {
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Fashion',
                'slug' => 'fashion',
                'icon' => 'fas fa-tshirt',
                'color' => 'pink',
                'products_count' => 45,
            ],
            (object)[
                'id' => 2,
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'icon' => 'fas fa-laptop',
                'color' => 'blue',
                'products_count' => 32,
            ],
            (object)[
                'id' => 3,
                'name' => 'Kecantikan',
                'slug' => 'kecantikan',
                'icon' => 'fas fa-spa',
                'color' => 'purple',
                'products_count' => 78,
            ],
            (object)[
                'id' => 4,
                'name' => 'Rumah Tangga',
                'slug' => 'rumah-tangga',
                'icon' => 'fas fa-home',
                'color' => 'green',
                'products_count' => 56,
            ],
            (object)[
                'id' => 5,
                'name' => 'Olahraga',
                'slug' => 'olahraga',
                'icon' => 'fas fa-running',
                'color' => 'red',
                'products_count' => 34,
            ],
            (object)[
                'id' => 6,
                'name' => 'Mainan',
                'slug' => 'mainan',
                'icon' => 'fas fa-gamepad',
                'color' => 'yellow',
                'products_count' => 23,
            ],
        ]);
    }

    /**
     * Get dummy testimonials for fallback
     */
    private function getDummyTestimonials()
    {
        return collect([
            (object)[
                'customer_name' => 'Sarah Johnson',
                'rating' => 5,
                'comment' => 'Produk sangat berkualitas dan pengiriman cepat! Sudah berkali-kali belanja di sini dan selalu puas.',
            ],
            (object)[
                'customer_name' => 'Budi Santoso',
                'rating' => 4,
                'comment' => 'Pelayanan memuaskan, barang sesuai deskripsi. Harga juga kompetitif dibanding toko lain.',
            ],
            (object)[
                'customer_name' => 'Maya Wijaya',
                'rating' => 5,
                'comment' => 'Kualitas produk premium, packing aman, dan CS responsif. Highly recommended!',
            ],
        ]);
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the shop page.
     */
    public function shop(Request $request)
    {
        $query = Product::with(['category', 'images'])
            ->where('is_active', true);

        // Filter by category
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Filter by search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter by price range
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by min price
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Sort products
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('sold_count', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        // Paginate results
        $products = $query->paginate(12);

        // Get all active categories for filter
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->get();

        // Current category if filtered
        $currentCategory = null;
        if ($request->has('category')) {
            $currentCategory = Category::where('slug', $request->category)->first();
        }

        return view('shop', compact('products', 'categories', 'currentCategory'));
    }

    /**
     * Display product detail page.
     */
    public function productDetail($slug)
    {
        $product = Product::with([
            'category',
            'images',
            'reviews' => function ($query) {
                $query->where('is_approved', true)
                      ->with('user')
                      ->latest()
                      ->limit(5);
            },
            'reviews.user'
        ])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

        // Increment view count
        $product->increment('view_count');

        // Get related products (same category)
        $relatedProducts = Product::with(['category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }

    /**
     * Display privacy policy page.
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * Display terms and conditions page.
     */
    public function terms()
    {
        return view('terms');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display FAQ page.
     */
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara berbelanja di BUNNYPOPS?',
                'answer' => 'Anda bisa berbelanja dengan mudah melalui website kami. Pilih produk, tambahkan ke keranjang, lalu lakukan checkout.'
            ],
            [
                'question' => 'Apakah ada biaya pengiriman?',
                'answer' => 'Kami memberikan gratis ongkir untuk pembelian minimal Rp 500.000. Untuk pembelian di bawah itu, biaya pengiriman akan disesuaikan dengan lokasi.'
            ],
            [
                'question' => 'Berapa lama waktu pengiriman?',
                'answer' => 'Pengiriman dalam kota 1-2 hari, luar kota 3-5 hari kerja, dan luar pulau 5-7 hari kerja.'
            ],
            [
                'question' => 'Bagaimana cara pengembalian barang?',
                'answer' => 'Pengembalian dapat dilakukan dalam 7 hari setelah barang diterima dengan syarat dan ketentuan berlaku.'
            ],
            [
                'question' => 'Apakah produk di BUNNYPOPS original?',
                'answer' => 'Ya, semua produk yang kami jual 100% original dengan garansi resmi.'
            ],
            [
                'question' => 'Bagaimana cara menghubungi customer service?',
                'answer' => 'Anda bisa menghubungi kami melalui WhatsApp di 0812-3456-7890 atau email support@bunnypops.com'
            ],
        ];

        return view('faq', compact('faqs'));
    }
}