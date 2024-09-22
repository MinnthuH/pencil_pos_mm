<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create ([
            'id' => 1,
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '0987654321',
            'password' => Hash::make('12345678'),
            'shop_id' => 1,

        ]);
        User::create ([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0987654321',
            'password' => Hash::make('12345678'),
            'shop_id' => 1,

        ]);
        User::create ([
            'id' => 3,
            'name' => 'Cashier',
            'email' => 'cashier@gmail.com',
            'phone' => '0987654321',
            'password' => Hash::make('12345678'),
            'shop_id' => 2,

        ]);

        $superadmin->assignRole('Super Admin');

    }
}
