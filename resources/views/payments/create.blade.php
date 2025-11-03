@extends('admim.layouts.app')


@section('content')
<div class="container">
    <h2>Add Payment</h2>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Invoice</label>
            <select name="invoice_id" class="form-control" required>
                @foreach(\App\Models\Invoice::all() as $invoice)
                <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }} ({{ $invoice->status }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label>Payment Date</label>
            <input type="date" name="payment_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
