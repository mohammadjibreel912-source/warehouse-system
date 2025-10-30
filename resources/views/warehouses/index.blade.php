@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">All Warehouses</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('warehouses.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Warehouse
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Current Lease</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->location }}</td>
                          <td>
    @if($warehouse->currentLease)
        @php
            $endDate = \Carbon\Carbon::parse($warehouse->currentLease->end_date);
            $today = \Carbon\Carbon::today();
        @endphp

        @if($endDate->isFuture())
            <span class="badge bg-success">
                {{ $warehouse->currentLease->tenant_name }} - Ends: {{ $endDate->format('Y-m-d') }}
            </span>
        @else
            <span class="badge bg-danger">
                {{ $warehouse->currentLease->tenant_name }} - Expired: {{ $endDate->format('Y-m-d') }}
            </span>
        @endif
    @else
        <span class="badge bg-secondary">No active lease</span>
    @endif
</td>

                            <td>
                                <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" class="d-inline">
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

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $warehouses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
