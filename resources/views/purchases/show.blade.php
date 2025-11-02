@extends('admim.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Purchase Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product: {{ $purchase->product->name ?? 'N/A' }}</h5>
            <p class="card-text"><strong>Supplier:</strong> {{ $purchase->supplier->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $purchase->quantity }}</p>
            <p class="card-text"><strong>Cost:</strong> ${{ number_format($purchase->cost, 2) }}</p>
            <p class="card-text"><strong>Purchase Date:</strong> {{ $purchase->purchase_date->format('Y-m-d') }}</p>

            <p class="card-text"><strong>Created At:</strong> {{ $purchase->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $purchase->updated_at->format('Y-m-d H:i:s') }}</p>

            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this purchase?')">Delete</button>
            </form>

            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Back to Purchases</a>
        </div>
    </div>
</div>
@endsection
