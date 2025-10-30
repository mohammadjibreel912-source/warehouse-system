<?php

namespace App\Http\Controllers;

use App\Repositories\WarehouseRepository;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $warehouseRepo;

    public function __construct(WarehouseRepository $warehouseRepo)
    {
        $this->middleware('auth');
        $this->warehouseRepo = $warehouseRepo;
    }

    public function index()
    {
        $warehouses = $this->warehouseRepo->all();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'lease_start_date' => 'nullable|date',
            'lease_end_date' => 'nullable|date',
            'rent_amount' => 'nullable|numeric',
        ]);

        $this->warehouseRepo->create($data);

        return redirect()->route('warehouses.index')->with('success', 'Warehouse added successfully.');
    }

    public function edit($id)
    {
        $warehouse = $this->warehouseRepo->find($id);
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'lease_start_date' => 'nullable|date',
            'lease_end_date' => 'nullable|date',
            'rent_amount' => 'nullable|numeric',
        ]);

        $this->warehouseRepo->update($id, $data);

        return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy($id)
    {
        $this->warehouseRepo->delete($id);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
