<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $item = Item::findOrFail($id);

        return view('invoice', compact('item'));
    }

    public function store(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'shipping_address' => 'required|min:10|max:255',
            'postal_code' => 'required|numeric|digits:5',
            'quantity' => 'required|integer|min:1|max:' . $item->stock
        ]);

        $quantity = $request->quantity;
        $subtotal = $quantity * $item->price;

        $invoiceNumber =
            'INV-' .
            strtoupper(substr(uniqid(), 0, 8));

        $invoice = Invoice::create([
            'user_id' => auth()->user()->id,
            'invoice_number' => $invoiceNumber,
            'shipping_address' => $request->shipping_address,
            'postal_code' => $request->postal_code,
            'total_price' => $subtotal
        ]);

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'item_id' => $item->id,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ]);

        $item->stock -= $quantity;
        $item->save();

        return redirect()
            ->route('invoice.show')
            ->with('success', 'Invoice created successfully');
    }

    public function showInvoices()
    {
        $invoices = Invoice::where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('showInvoice', compact('invoices'));
    }
}
