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
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        InventoryMovement::create($request->all());

        return redirect()->route('inventory_movements.index')->with('success', 'Inventory movement added successfully.');
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
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $inventoryMovement->update($request->all());

        return redirect()->route('inventory_movements.index')->with('success', 'Inventory movement updated successfully.');
    }

    public function destroy(InventoryMovement $inventoryMovement)
    {
        $inventoryMovement->delete();
        return redirect()->route('inventory_movements.index')->with('success', 'Inventory movement deleted successfully.');
    }

    public function show(InventoryMovement $inventoryMovement)
{
    return view('inventory.show', compact('inventoryMovement'));
}

}
