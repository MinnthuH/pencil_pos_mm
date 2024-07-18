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
            'Sanck 1',
            'Snack 2',
            'Snack 3',
            'Snack 4',
            'Snack 5',
        ];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}
