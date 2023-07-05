<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([

            'category_name' => 'အချိုရည်',
        ]);
        Category::create([

            'category_name' => 'မုန့်ခြောက်',
        ]);
        Category::create([

            'category_name' => 'ခေါက်ဆွဲခြောက်',
        ]);
        Category::create([

            'category_name' => 'မီးဖိုချောင်သုံး',
        ]);
        Category::create([

            'category_name' => 'ကော်ဖီ နှင့် နို့မှုန့်',
        ]);
    }
}
