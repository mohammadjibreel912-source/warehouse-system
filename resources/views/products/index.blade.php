@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Products</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Product
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                            <th>Min Quantity</th>
                            <th>Expiry Date</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Warehouse</th>
                            <th>Movements</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr @if($product->quantity <= $product->min_quantity) class="table-danger" @endif>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->min_quantity }}</td>
                            <td>{{ $product->expiry_date ?? 'N/A' }}</td>
                            <td>{{ $product->purchase_price ?? 'N/A' }}</td>
                            <td>{{ $product->sale_price ?? 'N/A' }}</td>
                            <td>{{ $product->warehouse->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('inventory_movements.show', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i> Movements
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
