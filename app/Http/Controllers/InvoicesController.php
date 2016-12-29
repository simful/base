<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Invoice, InvoiceDetail;
use Auth;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::orderBy('created_at', 'desc');
        $status = $request->get('status', 'open');

        if ($status == 'canceled') {
            $invoices->whereStatus('Canceled');
        }
        else if ($status == 'completed') {
            $invoices->whereStatus('Completed');
        }
        else if ($status == 'open') {
            $invoices->whereIn('status', ['Draft', 'Sent', 'In Progress', 'Shipping']);
        }

        $invoices = $invoices->paginate(5)->appends($request->all());

        return view('invoices.index', compact('invoices', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_edit = false;
        $invoice = new Invoice;
        return view('invoices.form', compact('invoice', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
        ]);

        $invoice = new Invoice;
        $invoice->fill($request->all());
        $invoice->user_id = Auth::id();
        $invoice->save();

        if ($invoice->id) {
            return redirect('invoices/' .  $invoice->id);
        } else {
            return back()->withInput()->withErrors();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with('total')->find($id);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $is_edit = true;
        $invoice = Invoice::find($id);
        return view('invoices.form', compact('invoice', 'is_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return $invoice;
    }

    public function addItem(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $item = new InvoiceDetail($request->all());
        $item->invoice_id = $id;
        $item->save();

        return back();

        $invoice = Invoice::find($id);
        $invoice->details()->create($request->all());
    }

    public function removeItem($id)
    {
        $item = InvoiceDetail::find($id);
        $item->delete();

        return $item;
    }
}
