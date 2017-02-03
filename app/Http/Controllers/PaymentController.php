<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Invoice;

class PaymentController extends Controller
{
	// payment untuk sales invoice.
    public function sales($id)
	{
		// ambil invoice kemudian tentukan sisanya
		$invoice = Invoice::find($id);
		$unpaid_amount = $invoice->total[0]->price - $invoice->amount_paid;

		return view('payment.form');
	}
}
