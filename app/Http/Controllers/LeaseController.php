<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Warehouse;
use App\Models\Notification;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        $leases = Lease::with('warehouse')->get();
        return view('leases.index', compact('leases'));
    }

    public function create()
    {
        $warehouses = Warehouse::all();
        return view('leases.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'notify_before_days' => 'nullable|integer|min:0',
        ]);

        $lease = Lease::create($request->all());

        // إشعار التجديد
        Notification::create([
            'type' => 'lease',
            'message' => "Lease for warehouse {$lease->warehouse->name} will expire on {$lease->end_date}",
            'lease_id' => $lease->id,
        ]);

        return redirect()->route('leases.index')->with('success', 'Lease created successfully.');
    }

    public function show(Lease $lease)
    {
        return view('leases.show', compact('lease'));
    }

    public function edit(Lease $lease)
    {
        $warehouses = Warehouse::all();
        return view('leases.edit', compact('lease', 'warehouses'));
    }

    public function update(Request $request, Lease $lease)
    {
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rent_amount' => 'required|numeric|min:0',
            'notify_before_days' => 'nullable|integer|min:0',
        ]);

        $lease->update($request->all());

        Notification::create([
            'type' => 'lease',
            'message' => "Lease for warehouse {$lease->warehouse->name} will expire on {$lease->end_date}",
            'lease_id' => $lease->id,
        ]);

        return redirect()->route('leases.index')->with('success', 'Lease updated successfully.');
    }

    public function destroy(Lease $lease)
    {
        $lease->delete();
        return redirect()->route('leases.index')->with('success', 'Lease deleted successfully.');
    }
}
