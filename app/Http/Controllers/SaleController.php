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

        $product = Product::find($request->product_id);

        // التحقق من المخزون قبل البيع
        if ($request->quantity > $product->quantity) {
            return redirect()->back()->withErrors([
                'quantity' => "الكمية المطلوبة أكبر من المخزون المتوفر ({$product->quantity})"
            ])->withInput();
        }

        $sale = Sale::create($request->all());

        $product->quantity -= $sale->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => -$sale->quantity,
            'type' => 'sale',
        ]);

        if ($product->quantity >= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('sales.index')
            ->with('success', "Sale created successfully. Remaining stock: {$product->quantity} units.");
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

        $product = Product::find($request->product_id);
        $oldQuantity = $sale->quantity;
        $availableQuantity = $product->quantity + $oldQuantity; // المخزون الحالي + الكمية القديمة للصفقة

        // التحقق من المخزون قبل تعديل البيع
        if ($request->quantity >= $availableQuantity) {
            return redirect()->back()->withErrors([
                'quantity' => "الكمية المطلوبة أكبر من المخزون المتوفر ({$availableQuantity})"
            ])->withInput();
        }

        $sale->update($request->all());

        // تحديث المخزون بعد التعديل
        $product->quantity = $availableQuantity - $request->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $oldQuantity - $request->quantity,
            'type' => 'sale_adjusted',
        ]);

        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('sales.index')
            ->with('success', "Sale updated successfully. Remaining stock: {$product->quantity} units.");
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
