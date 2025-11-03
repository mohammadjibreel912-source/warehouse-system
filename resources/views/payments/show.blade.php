@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Payment #{{ $payment->id }} for Invoice #{{ $payment->invoice->invoice_number }}</h2>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="row mb-4">
        <!-- Payment & Invoice Info -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Invoice Details</h5>
                    <p><strong>Type:</strong> {{ ucfirst($payment->invoice->type) }}</p>
                    <p><strong>Customer/Supplier:</strong>
                        {{ $payment->invoice->type === 'sale' ? $payment->invoice->customer->name ?? '-' : $payment->invoice->supplier->name ?? '-' }}
                    </p>
                    <p><strong>Total:</strong> {{ number_format($payment->invoice->total_amount, 2) }}</p>
                    <p><strong>Paid:</strong> {{ number_format($payment->invoice->paid_amount, 2) }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge
                            {{ $payment->invoice->status === 'paid' ? 'bg-success' : ($payment->invoice->status === 'pending' ? 'bg-warning' : 'bg-info') }}">
                            {{ ucfirst($payment->invoice->status) }}
                        </span>
                    </p>
                    <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($payment->invoice->invoice_date)->format('Y-m-d') }}</p>
                    <p><strong>Due Date:</strong> {{ optional($payment->invoice->due_date)->format('Y-m-d') ?? '-' }}</p>

                    <hr>

                    <h5 class="card-title mt-3">Payment Details</h5>
                    <p><strong>Amount:</strong> {{ number_format($payment->amount, 2) }}</p>
                    <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</p>
                    <p><strong>Method:</strong> {{ ucfirst($payment->payment_method ?? '-') }}</p>
                </div>
            </div>
        </div>

        <!-- Items & All Payments -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Invoice Items</h5>
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
                                @foreach($payment->invoice->items as $item)
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
                    <h5 class="card-title mb-3">All Payments for this Invoice</h5>
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
                                @forelse($payment->invoice->payments as $invPayment)
                                <tr @if($invPayment->id === $payment->id) class="table-info fw-bold" @endif>
                                    <td>{{ number_format($invPayment->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($invPayment->payment_date)->format('Y-m-d') }}</td>
                                    <td>{{ ucfirst($invPayment->payment_method ?? '-') }}</td>
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
