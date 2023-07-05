<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(RoleTableSeeder::class);
       $this->call(UserSeeder::class);
       $this->call(CategorySeeder::class);
       $this->call(CustomerSeeder::class);
       $this->call(SupplierSeeder::class);
       $this->call(ProductSeeder::class);
    }
}
