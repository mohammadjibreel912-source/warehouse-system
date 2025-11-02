@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Purchases</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('purchases.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Purchase
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Purchase Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->supplier->name }}</td>
                            <td>{{ $purchase->product->name }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ number_format($purchase->cost, 2) }} JOD</td>
                            <td>{{ $purchase->purchase_date }}</td>
                            <td>
                                <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No purchases found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
