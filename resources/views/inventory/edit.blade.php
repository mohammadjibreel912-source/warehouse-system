@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Inventory Movement</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('inventory_movements.update', $inventoryMovement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $inventoryMovement->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="in" {{ $inventoryMovement->type == 'in' ? 'selected' : '' }}>In</option>
                        <option value="out" {{ $inventoryMovement->type == 'out' ? 'selected' : '' }}>Out</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                           value="{{ $inventoryMovement->quantity }}" required min="1">
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3">{{ $inventoryMovement->note }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bx bx-edit me-1"></i> Update Movement
                </button>
                <a href="{{ route('inventory_movements.index') }}" class="btn btn-secondary ms-2">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
