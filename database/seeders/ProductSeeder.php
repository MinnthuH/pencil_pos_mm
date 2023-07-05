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
            'category_id' => 2,
            'supplier_id' => 1,
            'porduct_code' => 'Demo123',
            'product_garage'=>'A',
            'product_store' => 30,
            'selling_price' => 2500,
        ]);
        Product::create([
            'id' => 2,
            'product_name' => 'Pussy',
            'category_id' => 2,
            'supplier_id' => 2,
            'porduct_code' => 'Demo222',
            'product_garage'=>'B',
            'product_store' => 20,
            'selling_price' => 3000,
        ]);
        Product::create([
            'id' => 3,
            'product_name' => 'မားမား',
            'category_id' => 3,
            'supplier_id' => 1,
            'porduct_code' => 'Demo333',
            'product_garage'=>'c',
            'product_store' => 100,
            'selling_price' => 500,
        ]);
        Product::create([
            'id' => 4,
            'product_name' => 'ဆား',
            'category_id' => 4,
            'supplier_id' => 2,
            'porduct_code' => 'Demo444',
            'product_garage'=>'A',
            'product_store' => 70,
            'selling_price' => 700,
        ]);
        Product::create([
            'id' => 5,
            'product_name' => 'Premier Coffee',
            'category_id' => 5,
            'supplier_id' => 1,
            'porduct_code' => 'Demo555',
            'product_garage'=>'A',
            'product_store' => 300,
            'selling_price' => 250,
        ]);
    }
}
