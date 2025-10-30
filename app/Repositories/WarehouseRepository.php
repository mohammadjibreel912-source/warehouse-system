<?php

namespace App\Repositories;

use App\Models\Warehouse;

class WarehouseRepository
{
    public function all()
    {
        return Warehouse::all();
    }

    public function find($id)
    {
        return Warehouse::findOrFail($id);
    }

    public function create(array $data)
    {
        return Warehouse::create($data);
    }

    public function update($id, array $data)
    {
        $warehouse = $this->find($id);
        $warehouse->update($data);
        return $warehouse;
    }

    public function delete($id)
    {
        $warehouse = $this->find($id);
        return $warehouse->delete();
    }
}
