<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lease;
use App\Models\Warehouse;
use Carbon\Carbon;

class LeaseSeeder extends Seeder
{
    public function run()
    {
        $warehouses = Warehouse::all();
        foreach ($warehouses as $warehouse) {
            Lease::create([
                'warehouse_id' => $warehouse->id,
                'start_date' => Carbon::now()->subMonths(2),
                'end_date' => Carbon::now()->addMonths(10),
                'rent_amount' => rand(1000, 5000)
            ]);
        }
    }
}
