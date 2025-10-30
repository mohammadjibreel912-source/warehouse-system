@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Payment QR for {{ $spot->name }}</h4>

    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title mb-4">Scan the QR Code to Pay</h5>

            <div class="mb-4">
                {!! $qr !!}
            </div>

            <p class="fw-bold">
                Payment Code: <span class="text-primary">{{ $spot->payment_code }}</span>
            </p>

            <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary mt-3">
                <i class="bx bx-arrow-back me-1"></i> Back to Payments
            </a>
        </div>
    </div>
</div>
@endsection
