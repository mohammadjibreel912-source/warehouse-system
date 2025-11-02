@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">{{ isset($inventoryMovement) ? 'Edit' : 'Add' }} Inventory Movement</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ isset($inventoryMovement) ? route('inventory.update', $inventoryMovement->id) : route('inventory.store') }}" method="POST">
                @csrf
                @if(isset($inventoryMovement))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (old('product_id', $inventoryMovement->product_id ?? '') == $product->id) ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="in" {{ (old('type', $inventoryMovement->type ?? '') == 'in') ? 'selected' : '' }}>In</option>
                        <option value="out" {{ (old('type', $inventoryMovement->type ?? '') == 'out') ? 'selected' : '' }}>Out</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $inventoryMovement->quantity ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea name="note" class="form-control">{{ old('note', $inventoryMovement->note ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-{{ isset($inventoryMovement) ? 'warning' : 'success' }}">
                    <i class="bx bx-{{ isset($inventoryMovement) ? 'edit' : 'plus' }} me-1"></i>
                    {{ isset($inventoryMovement) ? 'Update' : 'Create' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
