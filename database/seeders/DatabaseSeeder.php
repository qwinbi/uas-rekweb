<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'api_token' => bin2hex(random_bytes(32)),
        ]);

        // Create guest user
        User::create([
            'name' => 'Guest User',
            'email' => 'user@email.com',
            'password' => Hash::make('4321'),
            'role' => 'guest',
            'api_token' => bin2hex(random_bytes(32)),
        ]);

        // Create sample products
        $products = [
            [
                'name' => 'Bunny Hoodie',
                'price' => 99000,
                'stock' => 12,
                'description' => 'Soft and warm bunny-themed hoodie perfect for cold days.',
                'photo' => null,
            ],
            [
                'name' => 'Bunny Plushie',
                'price' => 75000,
                'stock' => 25,
                'description' => 'Adorable bunny plushie with soft fur and cute expression.',
                'photo' => null,
            ],
            [
                'name' => 'Bunny Notebook',
                'price' => 35000,
                'stock' => 40,
                'description' => 'Cute bunny-themed notebook with high-quality pages.',
                'photo' => null,
            ],
            [
                'name' => 'Bunny Keychain',
                'price' => 25000,
                'stock' => 50,
                'description' => 'Small bunny keychain perfect for bags or keys.',
                'photo' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create default settings
        $settings = [
            ['key' => 'logo', 'value' => null],
            ['key' => 'footer_text', 'value' => '© 2024 BUNNYPOPS. All rights reserved.'],
            ['key' => 'footer_logo', 'value' => null],
            ['key' => 'about_image', 'value' => null],
            ['key' => 'about_description', 'value' => 'Additional description about BUNNYPOPS...'],
            ['key' => 'qris_image', 'value' => null],
            ['key' => 'virtual_account', 'value' => '1234567890'],
            ['key' => 'store_name', 'value' => 'BUNNYPOPS'],
            ['key' => 'store_description', 'value' => 'Your favorite cute e-commerce store'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}