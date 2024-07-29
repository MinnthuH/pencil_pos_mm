<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'id' => 1,
            'name' => 'Demo Suppler 1',
            'email' => 'demosupplier@gmail.com',
            'phone' => '09795516433',
            'address' => 'No 1 , Yangon',
            'shopname' => 'အောင်မြင်',
            'type' => 'Whole Sale',
        ]);
        Supplier::create([
            'id' => 2,
            'name' => 'Demo Suppler 2',
            'email' => 'demosupplier2@gmail.com',
            'phone' => '09795516233',
            'address' => 'No 2 , Mandalay',
            'shopname' => 'မဟာ',
            'type' => 'Destributor',
        ]);
    }
}
