<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Invoice, InvoiceDetail, Contact, Product, Account;
use Auth, DateTime;

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
        $invoice = new Invoice([
            'due_date' => new DateTime
        ]);
        $customers = Contact::orderBy('name')->get();
        return view('invoices.form', compact('invoice', 'customers', 'is_edit'));
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
        $products = Product::orderBy('name')->get();
        return view('invoices.show', compact('invoice', 'products'));
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
        $customers = Contact::orderBy('name')->get();
        return view('invoices.form', compact('invoice', 'customers', 'is_edit'));
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
        $this->validate($request, [
            'customer_id' => 'required',
        ]);

        $invoice = Invoice::find($id);
        $invoice->fill($request->all());
        $invoice->user_id = Auth::id();
        $invoice->save();

        return redirect('invoices/' .  $invoice->id);
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

    public function print($id)
    {
        $invoice = Invoice::find($id);
        return view('invoices.print', compact('invoice'));
    }

    public function addItem(Request $request, $id)
    {
        $this->validate($request, [
            'product_id' => 'required_without_all:description',
            'description' => 'required_without_all:product_id',
            'qty' => 'required|numeric',
            'price' => 'numeric',
        ]);

        $product = Product::find($request->product_id);

        $item = InvoiceDetail::whereInvoiceId($id)->whereProductId($request->product_id)->first();

        // kalau product id sama, tinggal tambah aja quantitynya
        if ($item) {
            $item->qty += $request->qty;
        } else {
            // masukkan item baru
            $item = new InvoiceDetail($request->all());
            $item->invoice_id = $id;
            $item->price = $product->sell_price;
            $item->price_nett = $product->buy_price;
        }

        $item->save();

        return back();
    }

    public function removeItem($id)
    {
        $item = InvoiceDetail::find($id);
        $item->delete();

        return $item;
    }

    public function process(Request $request, $id)
    {
        if ($request->action) {
            $invoice = Invoice::find($id);
            $invoice->process($request->action);
        }

        return $invoice;
    }

    public function showPayForm($id)
    {
        $accounts = Account::all();
        $cash_accounts = Account::whereAccountGroupId(1)->get();
        $invoice = Invoice::find($id);
        return view('invoices.pay', compact('invoice', 'cash_accounts', 'accounts'));
    }

    public function pay(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->postToJournal($request);
        return redirect("invoices/$id");
    }


}
