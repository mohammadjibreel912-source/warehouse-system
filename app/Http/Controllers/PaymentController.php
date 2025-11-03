<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
 public function index()
{
    $payments = Payment::with('invoice')->orderBy('payment_date', 'desc')->paginate(10);
    return view('payments.index', compact('payments'));
}

    public function create()
    {
        return view('payments.create');
    }



    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'amount' => 'required|numeric|min:0.01',
        'payment_date' => 'required|date',
        'payment_method' => 'nullable|string|max:255',
    ]);

    $payment = Payment::create($validated);

    // Update related invoice
    $invoice = $payment->invoice;
    $invoice->paid_amount = $invoice->payments()->sum('amount');
    $invoice->status = $invoice->paid_amount >= $invoice->total_amount ? 'paid' : ($invoice->paid_amount > 0 ? 'partial' : 'pending');
    $invoice->save();

    return redirect()
        ->route('payments.index')
        ->with('success', 'Payment added successfully!');
}

public function update(Request $request, Payment $payment)
{
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'payment_date' => 'required|date',
        'payment_method' => 'nullable|string|max:255',
    ]);

    $payment->update($validated);

    $invoice = $payment->invoice;
    $invoice->paid_amount = $invoice->payments()->sum('amount');
    $invoice->status = $invoice->paid_amount >= $invoice->total_amount ? 'paid' : ($invoice->paid_amount > 0 ? 'partial' : 'pending');
    $invoice->save();

    return redirect()
        ->route('payments.index')
        ->with('success', 'Payment updated successfully!');
}

public function destroy(Payment $payment)
{
    $invoice = $payment->invoice;
    $payment->delete();

    $invoice->paid_amount = $invoice->payments()->sum('amount');
    $invoice->status = $invoice->paid_amount >= $invoice->total_amount ? 'paid' : ($invoice->paid_amount > 0 ? 'partial' : 'pending');
    $invoice->save();

    return redirect()
        ->route('payments.index')
        ->with('success', 'Payment deleted successfully!');
}

}
