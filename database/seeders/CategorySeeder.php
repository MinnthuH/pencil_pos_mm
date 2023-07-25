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

            'category_name' => 'ဖျော်ရည်နှင့်ယာမကာ',
        ]);
        Category::create([

            'category_name' => 'မုန့်မျိုးစုံ',
        ]);
        Category::create([

            'category_name' => 'ဆေးဝါး',
        ]);
        Category::create([

            'category_name' => 'မီးဖိုချောင်သုံး',
        ]);
        Category::create([

            'category_name' => 'ကော်ဖီ နှင့် နို့မှုန့်',
        ]);
        Category::create([

            'category_name' => 'အလှကုန်',
        ]);
    }
}
