@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Add New Lease</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('leases.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Warehouse</label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rent Amount</label>
                    <input type="number" step="0.01" name="rent_amount" class="form-control" value="{{ old('rent_amount') }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bx bx-plus me-1"></i> Create Lease
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
