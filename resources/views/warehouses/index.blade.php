@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Warehouses</h2>
    <a href="{{ route('warehouses.create') }}" class="btn btn-primary mb-3">Add Warehouse</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Lease End</th>
                <th>Rent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->location }}</td>
                    <td>{{ $warehouse->lease_end_date }}</td>
                    <td>{{ $warehouse->rent_amount }}</td>
                    <td>
                        <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete warehouse?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
