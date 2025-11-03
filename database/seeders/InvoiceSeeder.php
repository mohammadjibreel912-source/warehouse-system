<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $suppliers = Supplier::all();
        $customers = Customer::all();
        $products = Product::all();

        // إنشاء 5 فواتير شراء
        for ($i = 1; $i <= 5; $i++) {
            $supplier = $suppliers->random();
            $invoice = Invoice::create([
                'invoice_number' => 'P-'.Str::upper(Str::random(6)),
                'type' => 'purchase',
                'supplier_id' => $supplier->id,
                'total_amount' => 0, // سيتم تحديثه لاحقاً
                'paid_amount' => 0,
                'status' => 'pending',
                'invoice_date' => now()->subDays(rand(1,30)),
                'due_date' => now()->addDays(rand(15, 60))
            ]);

            // إضافة 2-4 بنود
            $total = 0;
            foreach ($products->random(rand(2,4)) as $product) {
                $qty = rand(1,10);
                $price = $product->purchase_price ?? rand(10,50);
                $subtotal = $qty * $price;
                $total += $subtotal;

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'subtotal' => $subtotal
                ]);
            }

            // تحديث المجموع الكلي
            $invoice->update(['total_amount' => $total]);

            // إنشاء دفعة جزئية أو كاملة عشوائياً
            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => rand(0, $total),
                'payment_date' => now(),
                'payment_method' => ['cash','bank','card'][rand(0,2)]
            ]);
        }

        // إنشاء 5 فواتير بيع
        for ($i = 1; $i <= 5; $i++) {
            $customer = $customers->random();
            $invoice = Invoice::create([
                'invoice_number' => 'S-'.Str::upper(Str::random(6)),
                'type' => 'sale',
                'customer_id' => $customer->id,
                'total_amount' => 0,
                'paid_amount' => 0,
                'status' => 'pending',
                'invoice_date' => now()->subDays(rand(1,30)),
                'due_date' => now()->addDays(rand(15, 60))
            ]);

            $total = 0;
            foreach ($products->random(rand(1,5)) as $product) {
                $qty = rand(1,8);
                $price = $product->sale_price ?? rand(15,80);
                $subtotal = $qty * $price;
                $total += $subtotal;

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'subtotal' => $subtotal
                ]);
            }

            $invoice->update(['total_amount' => $total]);

            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => rand(0, $total),
                'payment_date' => now(),
                'payment_method' => ['cash','bank','card'][rand(0,2)]
            ]);
        }
    }
}
