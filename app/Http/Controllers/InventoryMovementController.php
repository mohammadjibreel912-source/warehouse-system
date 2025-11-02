<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function index()
    {
        $movements = InventoryMovement::with('product')->latest()->get();
        return view('inventory.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:' . implode(',', InventoryMovement::types()),
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // تحديد أنواع الحركات التي تزيد الكمية
        $incomingTypes = [
            InventoryMovement::TYPE_IN,
            InventoryMovement::TYPE_PURCHASE,
            InventoryMovement::TYPE_INITIAL_STOCK,
            InventoryMovement::TYPE_ADJUSTMENT,
        ];

        if (in_array($request->type, $incomingTypes)) {
            $product->quantity += $request->quantity;
        } else {
            $product->quantity -= $request->quantity;
        }

        $product->save();

        // إنشاء سجل الحركة
        InventoryMovement::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'note' => $request->note,
        ]);

        return redirect()->route('inventory_movements.index')
                         ->with('success', 'Inventory movement added successfully. Remaining quantity: ' . $product->quantity);
    }

    public function edit(InventoryMovement $inventoryMovement)
    {
        $products = Product::all();
        return view('inventory.edit', compact('inventoryMovement', 'products'));
    }

    public function update(Request $request, InventoryMovement $inventoryMovement)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:' . implode(',', InventoryMovement::types()),
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $product = Product::findOrFail($inventoryMovement->product_id);

        $incomingTypes = [
            InventoryMovement::TYPE_IN,
            InventoryMovement::TYPE_PURCHASE,
            InventoryMovement::TYPE_INITIAL_STOCK,
            InventoryMovement::TYPE_ADJUSTMENT,
        ];

        // عكس كمية الحركة القديمة
        if (in_array($inventoryMovement->type, $incomingTypes)) {
            $product->quantity -= $inventoryMovement->quantity;
        } else {
            $product->quantity += $inventoryMovement->quantity;
        }

        // تحديث الحركة
        $inventoryMovement->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'note' => $request->note,
        ]);

        // تطبيق كمية الحركة الجديدة
        if (in_array($request->type, $incomingTypes)) {
            $product->quantity += $request->quantity;
        } else {
            $product->quantity -= $request->quantity;
        }

        $product->save();

        return redirect()->route('inventory_movements.index')
                         ->with('success', 'Inventory movement updated successfully. Remaining quantity: ' . $product->quantity);
    }

    public function destroy(InventoryMovement $inventoryMovement)
    {
        $incomingTypes = [
            InventoryMovement::TYPE_IN,
            InventoryMovement::TYPE_PURCHASE,
            InventoryMovement::TYPE_INITIAL_STOCK,
            InventoryMovement::TYPE_ADJUSTMENT,
        ];

        $product = Product::findOrFail($inventoryMovement->product_id);

        // عكس الحركة عند الحذف
        if (in_array($inventoryMovement->type, $incomingTypes)) {
            $product->quantity -= $inventoryMovement->quantity;
        } else {
            $product->quantity += $inventoryMovement->quantity;
        }

        $product->save();

        $inventoryMovement->delete();

        return redirect()->route('inventory_movements.index')
                         ->with('success', 'Inventory movement deleted successfully. Remaining quantity: ' . $product->quantity);
    }

    public function show(InventoryMovement $inventoryMovement)
    {
        return view('inventory.show', compact('inventoryMovement'));
    }
}
