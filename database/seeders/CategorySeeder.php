<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Home Appliances',
            'Furniture',
            'Toys',
            'Books',
        ];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}
