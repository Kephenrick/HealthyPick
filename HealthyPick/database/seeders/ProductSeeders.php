<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Example images expected to be present in public/img
        $images = 'test.png';

        // Create 10 sample products

            Product::create([
                'Product_ID' => (string) Str::uuid(),
                'Name' => 'Product 12',
                'Description' => $faker->sentence(8),
                'Price' => $faker->numberBetween(10000, 150000),
                'Vendor_ID' => null,
                'Stock' => $faker->numberBetween(1, 50),
                'Image' => $images,
            ]);

    }
}
