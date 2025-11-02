@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Sales</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('sales.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Sale
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sale Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $sale->product->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>{{ number_format($sale->price, 2) }} JOD</td>
                            <td>{{ $sale->sale_date }}</td>
                            <td>
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="d-inline">
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
                            <td colspan="6" class="text-center">No sales found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
