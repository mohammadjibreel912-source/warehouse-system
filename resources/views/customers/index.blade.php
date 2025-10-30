@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Customers</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Customer
        </a>
    </div>

    <div class="row g-4">
        @foreach($customers as $customer)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 hover-shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $customer->name }}</h5>
                    <p class="card-text mb-1"><strong>Phone:</strong> {{ $customer->phone }}</p>
                    <p class="card-text mb-3"><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
