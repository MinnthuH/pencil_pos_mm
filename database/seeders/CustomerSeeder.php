<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'id' => 1,
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'phone' => '09795516433',
            'address' => 'No 1 , Yangon',
            'shopname' => 'Shop 1',
        ]);
    }
}
