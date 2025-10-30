@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Warehouse</h2>
    <form method="POST" action="{{ route('warehouses.update', $warehouse->id) }}">
        @csrf @method('PUT')
        @include('warehouses.form', ['warehouse' => $warehouse])
        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
