<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Shop::create ([
            'id' => 1,
            'name' => 'Pencil',
            'email' => 'pencil@gmail.com',
            'phone' => '0987654321',
            'address' => 'Yangon,Myanmar',
            'created_at' => Carbon::now(),
        ]);
    }
}
