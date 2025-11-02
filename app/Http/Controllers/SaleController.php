<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Notification;
use Illuminate\Http\Request;

class SaleController extends Controller
{
   public function index()
    {
        $sales = Sale::with(['customer', 'product'])->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('sales.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $sale = Sale::create($request->all());

        $product = Product::find($sale->product_id);
        $product->quantity -= $sale->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => -$sale->quantity,
            'type' => 'sale',
        ]);

        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('sales.edit', compact('sale', 'customers', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $oldQuantity = $sale->quantity;
        $sale->update($request->all());

        $product = Product::find($sale->product_id);
        $product->quantity += $oldQuantity - $sale->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $oldQuantity - $sale->quantity,
            'type' => 'sale_adjusted',
        ]);

        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $product = Product::find($sale->product_id);
        $product->quantity += $sale->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $sale->quantity,
            'type' => 'sale_deleted',
        ]);

        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
