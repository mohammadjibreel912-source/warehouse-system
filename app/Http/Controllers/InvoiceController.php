<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Payment;

class InvoiceController extends Controller
{
   public function index()
{
    $invoices = Invoice::with('items', 'payments', 'customer', 'supplier')
                       ->orderBy('invoice_date', 'desc')
                       ->paginate(10); // show 10 invoices per page

    return view('invoices.index', compact('invoices'));
}


    public function create()
    {
        return view('invoices.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'invoice_number' => 'required|string|max:255',
        'type' => 'required|string|in:sale,purchase',
        'invoice_date' => 'required|date',
    ]);

    // حساب المجموع الكلي للفاتورة من العناصر
    $total = 0;
    foreach ($request->items as $item) {
        $total += $item['quantity'] * $item['unit_price'];
    }

    // إنشاء الفاتورة مع total_amount
    $invoice = Invoice::create([
        'invoice_number' => $request->invoice_number,
        'type' => $request->type,
        'customer_id' => $request->customer_id,
        'supplier_id' => $request->supplier_id,
        'invoice_date' => $request->invoice_date,
        'due_date' => $request->due_date,
        'total_amount' => $total,
    ]);

    // إنشاء تفاصيل الفاتورة (العناصر)
    foreach ($request->items as $item) {
        $invoice->items()->create([
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['unit_price'],
            'subtotal' => $item['quantity'] * $item['unit_price'],
        ]);
    }

    return redirect()->route('invoices.index')
                     ->with('success', 'Invoice created successfully!');
}


  public function show(\App\Models\Invoice $invoice)
{
    // Eager load related models
    $invoice->load(['items.product', 'payments', 'customer', 'supplier']);

    return view('invoices.show', compact('invoice'));
}



    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        return redirect()->route('invoices.index', $invoice->id);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
                return redirect()->route('invoices.index')->with('success', 'Invoices deleted successfully.');

    }
}
