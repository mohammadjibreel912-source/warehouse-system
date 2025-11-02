<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\InventoryMovement;
use App\Models\Notification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('warehouse')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('products.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:50|unique:products,sku',
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        $product = Product::create($request->all());

        // سجل حركة المخزون
        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $product->quantity,
            'type' => 'initial_stock',
        ]);

        // تحقق من الحد الأدنى
        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $warehouses = Warehouse::all();
        return view('products.edit', compact('product', 'warehouses'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => "required|string|max:50|unique:products,sku,{$product->id}",
            'quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);

        $oldQuantity = $product->quantity;
        $product->update($request->all());

        // سجل حركة المخزون إذا تغيرت الكمية
        $diff = $product->quantity - $oldQuantity;
        if ($diff != 0) {
            InventoryMovement::create([
                'product_id' => $product->id,
                'quantity' => $diff,
                'type' => 'adjustment',
            ]);
        }

        // تحقق من الحد الأدنى
        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
