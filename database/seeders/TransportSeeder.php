<?php

namespace Database\Seeders;

use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transport::create([
            'id' => 1,
            'transport_type' => 'Car',
            'transport_chagre' => 5000,
            'created_at' => Carbon::now(),
        ]);
        Transport::create([
            'id' => 2,
            'transport_type' => 'Motocycle',
            'transport_chagre' => 3000,
            'created_at' => Carbon::now(),
        ]);
    }
}
