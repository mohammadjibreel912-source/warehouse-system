@extends('admim.layouts.app')

@section('title', 'Payment QR Code')

@section('content')
<div class="container">
    <h1 class="mb-4">Payment QR Code</h1>
    <div class="card p-4 text-center">
        {!! $qrCode !!}
        <p class="mt-3">Scan this QR code to pay</p>
    </div>
</div>
@endsection
