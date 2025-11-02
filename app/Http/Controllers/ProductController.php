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

    // التحقق من أن الكمية أكبر من الحد الأدنى
    if ($request->quantity <= $request->min_quantity) {
        return redirect()->back()->withInput()
            ->with('error', "Quantity must be greater than minimum quantity ({$request->min_quantity}).");
    }

    $product = Product::create($request->all());

    // إضافة حركة المخزون
    InventoryMovement::create([
        'product_id' => $product->id,
        'quantity' => $product->quantity,
    'type' => InventoryMovement::TYPE_INITIAL_STOCK, // بدل 'initial_stock'
    ]);

    return redirect()->route('products.index')
        ->with('success', "Product created successfully. Remaining stock: {$product->quantity}");
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

    // التحقق من الكمية
    if ($request->quantity <= $request->min_quantity) {
        return redirect()->back()->withInput()
            ->with('error', "Quantity must be greater than minimum quantity ({$request->min_quantity}).");
    }

    $oldQuantity = $product->quantity;
    $product->update($request->all());

    // حساب الفرق وإضافة حركة المخزون
    $diff = $product->quantity - $oldQuantity;
    if ($diff != 0) {
        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $diff,
        'type' => InventoryMovement::TYPE_ADJUSTMENT, // بدل 'adjustment'
        ]);
    }

    return redirect()->route('products.index')
        ->with('success', "Product updated successfully. Remaining stock: {$product->quantity}");
}

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('products.create', compact('warehouses'));
    }



    public function edit(Product $product)
    {
        $warehouses = Warehouse::all();
        return view('products.edit', compact('product', 'warehouses'));
    }



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
