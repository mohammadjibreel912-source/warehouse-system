@extends('admim.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h2 class="fw-bold mb-4">Edit Invoice #{{ $invoice->invoice_number }}</h2>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Invoice Number</label>
            <input type="text" name="invoice_number" class="form-control"
                   value="{{ old('invoice_number', $invoice->invoice_number) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="sale" {{ old('type', $invoice->type) == 'sale' ? 'selected' : '' }}>Sale</option>
                <option value="purchase" {{ old('type', $invoice->type) == 'purchase' ? 'selected' : '' }}>Purchase</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Customer (for sale)</label>
            <select name="customer_id" class="form-select">
                <option value="">-- Select --</option>
                @foreach(\App\Models\Customer::all() as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id', $invoice->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Supplier (for purchase)</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Select --</option>
                @foreach(\App\Models\Supplier::all() as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $invoice->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Invoice Date</label>
            <input type="date" name="invoice_date" class="form-control"
                   value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Due Date</label>
            <input type="date" name="due_date" class="form-control"
                   value="{{ old('due_date', optional($invoice->due_date)->format('Y-m-d')) }}">
        </div>

        <h5 class="mt-4">Invoice Items</h5>
        <div id="items-container">
            @foreach($invoice->items as $index => $item)
                <div class="item-row mb-2 d-flex gap-2 align-items-center">
                    <select name="items[{{ $index }}][product_id]" class="form-select" required>
                        <option value="">-- Select Product --</option>
                        @foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="items[{{ $index }}][quantity]" class="form-control" placeholder="Qty" min="1" required
                           value="{{ $item->quantity }}">
                    <input type="number" name="items[{{ $index }}][unit_price]" class="form-control" placeholder="Unit Price" step="0.01" required
                           value="{{ $item->unit_price }}">
                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-item" class="btn btn-secondary mt-2">Add Item</button>

        <button type="submit" class="btn btn-primary mt-4"><i class="bx bx-save"></i> Update Invoice</button>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary mt-4">Cancel</a>
    </form>
</div>

<script>
let index = {{ $invoice->items->count() }};

document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('items-container');
    const row = document.createElement('div');
    row.classList.add('item-row', 'mb-2', 'd-flex', 'gap-2', 'align-items-center');
    row.innerHTML = `
        <select name="items[${index}][product_id]" class="form-select" required>
            <option value="">-- Select Product --</option>
            @foreach(\App\Models\Product::all() as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <input type="number" name="items[${index}][quantity]" class="form-control" placeholder="Qty" min="1" required>
        <input type="number" name="items[${index}][unit_price]" class="form-control" placeholder="Unit Price" step="0.01" required>
        <button type="button" class="btn btn-danger btn-remove">Remove</button>
    `;
    container.appendChild(row);
    index++;
});

// Remove item row
document.addEventListener('click', function(e){
    if(e.target.classList.contains('btn-remove')){
        e.target.closest('.item-row').remove();
    }
});
</script>
@endsection
