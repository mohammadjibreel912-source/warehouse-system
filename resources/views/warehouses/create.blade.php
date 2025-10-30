@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Warehouse</h2>
    <form method="POST" action="{{ route('warehouses.store') }}">
        @csrf
        @include('warehouses.form')
        <button type="submit" class="btn btn-success mt-2">Save</button>
    </form>
</div>
@endsection
