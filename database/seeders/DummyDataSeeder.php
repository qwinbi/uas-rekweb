<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin BUNNYPOPS',
            'email' => 'admin@bunnypops.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No. 123, Jakarta',
        ]);

        // Create regular user
        $user = User::create([
            'name' => 'Customer Example',
            'email' => 'customer@bunnypops.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'customer',
            'phone' => '081234567891',
            'address' => 'Jl. Pelanggan No. 456, Bandung',
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Fashion',
                'description' => 'Pakaian dan aksesoris fashion terkini',
                'icon' => 'fas fa-tshirt',
                'color' => 'pink',
            ],
            [
                'name' => 'Elektronik',
                'description' => 'Perangkat elektronik dan gadget',
                'icon' => 'fas fa-laptop',
                'color' => 'blue',
            ],
            [
                'name' => 'Kecantikan',
                'description' => 'Produk kecantikan dan perawatan diri',
                'icon' => 'fas fa-spa',
                'color' => 'purple',
            ],
            [
                'name' => 'Rumah Tangga',
                'description' => 'Perabotan dan perlengkapan rumah',
                'icon' => 'fas fa-home',
                'color' => 'green',
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Alat dan pakaian olahraga',
                'icon' => 'fas fa-running',
                'color' => 'red',
            ],
            [
                'name' => 'Mainan',
                'description' => 'Mainan dan hiburan',
                'icon' => 'fas fa-gamepad',
                'color' => 'yellow',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create products
        $products = [
            [
                'name' => 'Kemeja Flanel Premium',
                'description' => 'Kemeja flanel dengan bahan premium, nyaman dipakai sehari-hari maupun acara formal.',
                'price' => 299000,
                'discount' => 15,
                'stock' => 50,
                'sku' => 'FP001',
                'category_id' => 1,
                'rating' => 4.5,
                'reviews_count' => 24,
                'sold_count' => 120,
                'specifications' => json_encode([
                    'Bahan' => 'Flanel Premium',
                    'Warna' => 'Merah, Biru, Hitam',
                    'Ukuran' => 'S, M, L, XL',
                    'Perawatan' => 'Cuci tangan, jangan bleach',
                ]),
            ],
            [
                'name' => 'Smartphone X Pro',
                'description' => 'Smartphone flagship dengan kamera 108MP dan baterai 5000mAh.',
                'price' => 8999000,
                'discount' => 10,
                'stock' => 25,
                'sku' => 'SP002',
                'category_id' => 2,
                'rating' => 4.8,
                'reviews_count' => 156,
                'sold_count' => 89,
                'specifications' => json_encode([
                    'Layar' => '6.7" AMOLED',
                    'Processor' => 'Snapdragon 8 Gen 2',
                    'RAM' => '12GB',
                    'Storage' => '256GB',
                    'Baterai' => '5000mAh',
                ]),
            ],
            [
                'name' => 'Lipstick Matte Collection',
                'description' => 'Lipstick matte dengan warna tahan lama dan tidak mudah luntur.',
                'price' => 149000,
                'discount' => 20,
                'stock' => 100,
                'sku' => 'LC003',
                'category_id' => 3,
                'rating' => 4.3,
                'reviews_count' => 67,
                'sold_count' => 234,
                'specifications' => json_encode([
                    'Tipe' => 'Matte',
                    'Warna' => '10 varian',
                    'Berat' => '3.5g',
                    'Tahan Lama' => '8-10 jam',
                ]),
            ],
            [
                'name' => 'Blender Multifungsi',
                'description' => 'Blender dengan 8 kecepatan dan 4 fungsi untuk kebutuhan dapur Anda.',
                'price' => 499000,
                'discount' => 0,
                'stock' => 30,
                'sku' => 'BM004',
                'category_id' => 4,
                'rating' => 4.6,
                'reviews_count' => 45,
                'sold_count' => 78,
                'specifications' => json_encode([
                    'Daya' => '800W',
                    'Kapasitas' => '2L',
                    'Kecepatan' => '8 tingkat',
                    'Material' => 'Plastik food grade',
                ]),
            ],
            [
                'name' => 'Sepatu Lari Premium',
                'description' => 'Sepatu lari dengan teknologi cushioning terbaik untuk kenyamanan maksimal.',
                'price' => 799000,
                'discount' => 25,
                'stock' => 40,
                'sku' => 'SL005',
                'category_id' => 5,
                'rating' => 4.7,
                'reviews_count' => 89,
                'sold_count' => 156,
                'specifications' => json_encode([
                    'Tipe' => 'Running Shoes',
                    'Bahan' => 'Mesh breathable',
                ]),
            ],
            [
                'name' => 'Set Lego Creator',
                'description' => 'Set Lego dengan 1500 piece untuk mengasah kreativitas.',
                'price' => 1299000,
                'discount' => 15,
                'stock' => 20,
                'sku' => 'LC006',
                'category_id' => 6,
                'rating' => 4.9,
                'reviews_count' => 123,
                'sold_count' => 45,
                'specifications' => json_encode([
                    'Jumlah Piece' => '1500',
                    'Usia' => '12+ tahun',
                    'Dimensi' => '45 x 35 x 10 cm',
                ]),
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::create($productData);

            // Add product images
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/dummy.jpg',
                'alt_text' => $product->name,
                'order' => 1,
                'is_primary' => true,
            ]);

            // Add reviews
            for ($i = 1; $i <= 5; $i++) {
                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => rand(4, 5),
                    'comment' => $this->getRandomReviewComment(),
                    'is_approved' => true,
                    'verified_purchase' => true,
                    'images' => json_encode([]),
                ]);
            }
        }

        $this->command->info('Dummy data created successfully!');
    }

    private function getRandomReviewComment()
    {
        $comments = [
            'Produk sangat bagus, kualitas premium!',
            'Pengiriman cepat, produk sesuai deskripsi.',
            'Worth it untuk harga segini, sangat recommended!',
            'Barang original, packing rapi. Puas banget!',
            'Seller ramah, produk berkualitas. Akan repeat order.',
            'Warnanya cantik, bahan nyaman. Suka banget!',
            'Fungsional dan tahan lama, sangat berguna.',
            'Desain elegan, fitur lengkap. Recommended!',
            'Cocok untuk kebutuhan sehari-hari, praktis.',
            'Harga terjangkau untuk kualitas yang didapat.',
        ];

        return $comments[array_rand($comments)];
    }
}