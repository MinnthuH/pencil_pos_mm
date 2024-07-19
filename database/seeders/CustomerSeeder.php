<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            Customer::create([
                'name' => 'customer1',
                'email' => 'customer1@gmail.com',
                'phone' => '0977886655',
                'address' => 'Yangon',
                'shopname' => 'Mingalar',
            ]);

    }
}
