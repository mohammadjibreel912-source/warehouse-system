<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;

class SaleSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::all();
        $products = Product::all();

        foreach ($products as $product) {
            Sale::create([
                'customer_id' => $customers->random()->id,
                'product_id' => $product->id,
                'quantity' => rand(1, 10),
                'price' => $product->sale_price,
                'sale_date' => Carbon::now()->subDays(rand(0, 15))
            ]);
        }
    }
}
