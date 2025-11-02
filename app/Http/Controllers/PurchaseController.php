<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\InventoryMovement;
use App\Models\Notification;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'product'])->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase = Purchase::create($request->all());

        // تحديث كمية المنتج
        $product = Product::find($purchase->product_id);
        $product->quantity += $purchase->quantity;
        $product->save();

        // سجل حركة المخزون
        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $purchase->quantity,
            'type' => 'purchase',
        ]);

        // تحقق من الحد الأدنى
        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        // تعديل كمية المنتج
        $oldQuantity = $purchase->quantity;
        $purchase->update($request->all());

        $product = Product::find($purchase->product_id);
        $product->quantity = $product->quantity - $oldQuantity + $purchase->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => $purchase->quantity - $oldQuantity,
            'type' => 'purchase',
        ]);

        // تحقق من الحد الأدنى
        if ($product->quantity <= $product->min_quantity) {
            Notification::create([
                'type' => 'stock',
                'message' => "Product {$product->name} is below minimum stock.",
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        // تعديل كمية المنتج عند حذف عملية الشراء
        $product = Product::find($purchase->product_id);
        $product->quantity -= $purchase->quantity;
        $product->save();

        InventoryMovement::create([
            'product_id' => $product->id,
            'quantity' => -$purchase->quantity,
            'type' => 'purchase_deleted',
        ]);

        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }
}
