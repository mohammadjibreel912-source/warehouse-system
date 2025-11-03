@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Invoice #{{ $invoice->invoice_number }}</h2>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Invoice Details</h5>
                    <p><strong>Type:</strong> {{ ucfirst($invoice->type) }}</p>
                    <p><strong>Customer/Supplier:</strong>
                        {{ $invoice->type === 'sale' ? $invoice->customer->name ?? '-' : $invoice->supplier->name ?? '-' }}
                    </p>
                    <p><strong>Total:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
                    <p><strong>Paid:</strong> {{ number_format($invoice->paid_amount, 2) }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge
                            {{ $invoice->status === 'paid' ? 'bg-success' : ($invoice->status === 'pending' ? 'bg-warning' : 'bg-info') }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </p>
                    <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('Y-m-d') }}</p>
                    <p><strong>Due Date:</strong> {{ optional($invoice->due_date)->format('Y-m-d') ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Items</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->unit_price, 2) }}</td>
                                    <td>{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3">Payments</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoice->payments as $payment)
                                <tr>
                                    <td>{{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                                    <td>{{ $payment->payment_method ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No payments yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
