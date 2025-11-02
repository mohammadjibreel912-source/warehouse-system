@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Inventory Movements</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('inventory_movements.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add Movement
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Note</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movements as $movement)
                        <tr>
                            <td>{{ $movement->product->name }}</td>
                            <td>{{ ucfirst($movement->type) }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->note ?? '-' }}</td>
                            <td>{{ $movement->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('inventory_movements.edit', $movement->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('inventory_movements.destroy', $movement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bx bx-trash"></i>
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
