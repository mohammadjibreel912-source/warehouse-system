<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\InventoryMovement;

class InventoryMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('⚠️ No products found. Please seed the products table first.');
            return;
        }

        foreach ($products as $product) {
            // Create random 'in' and 'out' movements for each product
            for ($i = 0; $i < rand(3, 7); $i++) {
                InventoryMovement::create([
                    'product_id' => $product->id,
                    'type' => fake()->randomElement(['in', 'out']),
                    'quantity' => fake()->numberBetween(1, 20),
                    'note' => fake()->sentence(),
                    'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
                ]);
            }
        }

        $this->command->info('✅ Inventory movements seeded successfully.');
    }
}
