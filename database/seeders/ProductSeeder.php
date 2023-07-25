<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => 1,
            'product_name' => 'Shark',
            'category_id' => 1,
            'supplier_id' => 1,
            'product_code' => 'Demo123',
            'product_garage'=>'A',
            'product_store' => 30,
            'product_track' => 5,
            'selling_price' => 2500,
        ]);
        Product::create([
            'id' => 2,
            'product_name' => 'Pussy',
            'category_id' => 2,
            'supplier_id' => 2,
            'product_code' => 'Demo222',
            'product_garage'=>'B',
            'product_store' => 20,
            'product_track' => 5,
            'selling_price' => 3000,
        ]);
        Product::create([
            'id' => 3,
            'product_name' => 'မားမား',
            'category_id' => 4,
            'supplier_id' => 1,
            'product_code' => 'Demo333',
            'product_garage'=>'c',
            'product_store' => 100,
            'product_track' => 10,
            'selling_price' => 500,
        ]);
        Product::create([
            'id' => 4,
            'product_name' => 'ဆား',
            'category_id' => 4,
            'supplier_id' => 2,
            'product_code' => 'Demo444',
            'product_garage'=>'A',
            'product_store' => 5,
            'product_track' => 10,
            'selling_price' => 700,
        ]);
        Product::create([
            'id' => 5,
            'product_name' => 'Premier Coffee',
            'category_id' => 5,
            'supplier_id' => 1,
            'product_code' => 'Demo555',
            'product_garage'=>'A',
            'product_store' => 300,
            'product_track' => 10,
            'selling_price' => 250,
        ]);
        Product::create([
            'id' => 6,
            'product_name' => 'ရေသန့်',
            'category_id' => 1,
            'supplier_id' => 1,
            'product_code' => 'Demo666',
            'product_garage'=>'A',
            'product_store' => 500,
            'product_track' => 50,
            'selling_price' => 250,
        ]);
        Product::create([
            'id' => 7,
            'product_name' => 'PEP နို့မှုန့်',
            'category_id' => 5,
            'supplier_id' => 2,
            'product_code' => 'Demo777',
            'product_garage'=>'A',
            'product_store' => 100,
            'product_track' => 10,
            'selling_price' => 300,
        ]);
        Product::create([
            'id' => 8,
            'product_name' => 'Jack Daniel',
            'category_id' => 1,
            'supplier_id' => 1,
            'product_code' => 'Demo888',
            'product_garage'=>'A',
            'product_store' => 20,
            'product_track' => 2,
            'selling_price' => 50000,
        ]);
        Product::create([
            'id' => 9,
            'product_name' => 'ပါရာကပ်',
            'category_id' => 3,
            'supplier_id' => 1,
            'product_code' => 'Demo999',
            'product_garage'=>'A',
            'product_store' => 100,
            'product_track' => 5,
            'selling_price' => 500,
        ]);
        Product::create([
            'id' => 10,
            'product_name' => 'Nivea Roll on',
            'category_id' => 6,
            'supplier_id' => 1,
            'product_code' => 'Demo000',
            'product_garage'=>'A',
            'product_store' => 20,
            'product_track' => 3,
            'selling_price' => 50000,
        ]);
    }
}
