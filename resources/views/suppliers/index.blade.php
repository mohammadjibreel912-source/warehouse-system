@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Suppliers</h4>


    <div class="mb-4">
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Supplier
        </a>
    </div>

    <div class="row g-4">
        @foreach($suppliers as $supplier)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 hover-shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $supplier->name }}</h5>
                    <p class="card-text mb-1"><strong>Phone:</strong> {{ $supplier->phone }}</p>
                    <p class="card-text mb-3"><strong>Address:</strong> {{ $supplier->address ?? 'N/A' }}</p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                      <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline delete-form">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-danger btn-delete">
        <i class="bx bx-trash"></i> Delete
    </button>
</form>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
