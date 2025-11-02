@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Lease</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('leases.update', $lease->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Warehouse</label>
                    <select name="warehouse_id" class="form-select" required>
                        <option value="">Select Warehouse</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $lease->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $lease->start_date->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $lease->end_date->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rent Amount</label>
                    <input type="number" step="0.01" name="rent_amount" class="form-control" value="{{ old('rent_amount', $lease->rent_amount) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save me-1"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
