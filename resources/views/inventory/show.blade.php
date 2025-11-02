@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Inventory Movement Details</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Product:</label>
                <p class="form-control-plaintext">{{ $inventoryMovement->product->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Type:</label>
                <p class="form-control-plaintext">{{ ucfirst($inventoryMovement->type) }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Quantity:</label>
                <p class="form-control-plaintext">{{ $inventoryMovement->quantity }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Note:</label>
                <p class="form-control-plaintext">{{ $inventoryMovement->note ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Created At:</label>
                <p class="form-control-plaintext">{{ $inventoryMovement->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Updated At:</label>
                <p class="form-control-plaintext">{{ $inventoryMovement->updated_at->format('Y-m-d H:i') }}</p>
            </div>

            <a href="{{ route('inventory_movements.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
