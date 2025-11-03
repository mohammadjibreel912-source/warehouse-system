<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function store(Request $request)
    {
        InvoiceItem::create($request->all());
        return back();
    }

    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $invoiceItem->update($request->all());
        return back();
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();
        return back();
    }
}
