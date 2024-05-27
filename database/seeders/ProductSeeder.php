<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Assuming you have the following categories and suppliers
        $categories = [1, 2, 3, 4, 5]; // Example category IDs
        $suppliers = [1, 2]; // Example supplier IDs
        $garages = ['A', 'B', 'C']; // Example garages
        // Get current date
        $currentDate = now();

        // Add two years to the current date
        $expireDate = $currentDate->copy()->addYears(2);

        $fakeProductNames = [
            'CozyNest Comforter', 'AquaGlide Shower Curtain', 'FreshBreeze Air Purifier',
            'Lumina Glow Lamp', 'SilentWhisper Ceiling Fan', 'PureWave Water Filter',
            'HarmonyTone Bluetooth Speaker', 'ComfortCloud Mattress Topper',
            'SwiftSweep Robot Vacuum', 'EcoGuard Recycling Bin', 'LuxeSilk Bed Sheets',
            'GentleDry Towels', 'SparkleShine Window Cleaner', 'WarmHaven Electric Blanket',
            'EcoFlow Faucet Aerator', 'BreezeCool Tower Fan', 'SoftTouch Pillows',
            'SparkClean Dishwasher Pods', 'FreshBliss Reed Diffuser', 'CozyHug Throw Blanket',
            'BrightBeam LED Bulbs', 'PureBreeze Humidifier', 'SereneSounds White Noise Machine',
            'AquaShield Shower Mat', 'VelvetFeel Duvet Cover', 'EasyFold Laundry Basket',
            'BlissMorn Coffee Maker', 'QuietGuard Door Seal', 'CleanSweep Broom Set',
            'EcoLite Solar Lantern', 'ScentWave Wax Warmer', 'DreamZone Sleep Mask',
            'QuickDry Bath Mat', 'ChillEase Cooling Pad', 'SoftGlow Night Light',
            'RapidHeat Microwaveable Heating Pad', 'AquaLux Bathrobe', 'CozyCradle Baby Bassinet',
            'SmoothMove Furniture Sliders', 'PureMist Essential Oil Diffuser',
            'Sunbeam Garden Lights', 'WhisperSoft Air Conditioner', 'UltraSeal Food Storage Containers',
            'FreshWave Odor Eliminator', 'SnugRest Pet Bed', 'AquaFrost Ice Maker',
            'FlexClean Mop System', 'GentleGrip Hangers', 'DreamComfort Recliner',
            'CozyNest Floor Cushion',
        ];

        foreach ($fakeProductNames as $index => $productName) {
            Product::create([
                'id' => $index + 1,
                'product_name' => $productName,
                'category_id' => $faker->randomElement($categories),
                'supplier_id' => $faker->randomElement($suppliers),
                'product_code' => $faker->bothify('Demo###'),
                'product_garage' => $faker->randomElement($garages),
                'product_store' => $faker->numberBetween(10, 500),
                'product_track' => $faker->numberBetween(1, 20),
                'buying_date' => $faker->date(),
                'expire_date' => $expireDate->format('Y-m-d'),
                'buy_price' => $faker->numberBetween(100, 1000) * 100,
                'selling_price' => $faker->numberBetween(150, 1500) * 100,
                // Omit 'product_image' and 'unit'
            ]);
        }
    }
}
