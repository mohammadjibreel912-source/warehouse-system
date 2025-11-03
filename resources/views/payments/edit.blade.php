@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Payment #{{ $payment->id }}</h2>
        <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="invoice_id" class="form-label">Invoice</label>
                    <select name="invoice_id" id="invoice_id" class="form-select" required>
                        @foreach(\App\Models\Invoice::all() as $invoice)
                        <option value="{{ $invoice->id }}" {{ $payment->invoice_id == $invoice->id ? 'selected' : '' }}>
                            {{ $invoice->invoice_number }} ({{ $invoice->status }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                        value="{{ old('amount', $payment->amount) }}" required>
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" id="payment_date" class="form-control"
                        value="{{ old('payment_date', \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <input type="text" name="payment_method" id="payment_method" class="form-control"
                        value="{{ old('payment_method', $payment->payment_method) }}">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bx bx-save"></i> Update Payment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
