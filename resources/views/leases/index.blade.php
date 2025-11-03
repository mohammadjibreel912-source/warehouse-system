@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Leases</h4>


    <div class="mb-4">
        <a href="{{ route('leases.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Lease
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Warehouse</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Rent Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leases as $lease)
                        <tr>
                            <td>{{ $lease->id }}</td>
                            <td>{{ $lease->warehouse->name ?? 'N/A' }}</td>
                            <td>{{ $lease->start_date->format('Y-m-d') }}</td>
                            <td>{{ $lease->end_date->format('Y-m-d') }}</td>
                            <td>${{ number_format($lease->rent_amount, 2) }}</td>
                            <td>
                                <a href="{{ route('leases.edit', $lease->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('leases.destroy', $lease->id) }}" method="POST" class="d-inline btn-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" >
                                        <i class="bx bx-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if($leases->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">No leases found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
