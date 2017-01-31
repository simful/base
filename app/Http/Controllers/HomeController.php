<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Transaction, Account, Product, Invoice;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::connection('tenant')->select(
            "SELECT
                (SELECT sum(invoice_details.price) FROM invoices, invoice_details WHERE invoices.id = invoice_details.invoice_id AND invoices.paid = 0) as unpaid,
                (SELECT sum(invoice_details.price) FROM invoices, invoice_details WHERE invoices.id = invoice_details.invoice_id AND invoices.due_date = CURDATE()) as due,
                (SELECT sum(invoice_details.price) FROM invoices, invoice_details WHERE invoices.id = invoice_details.invoice_id AND invoices.paid = 1) as paid")[0];

        $purchases = DB::connection('tenant')->select(
            "SELECT
                (SELECT sum(purchase_details.price) FROM purchases, purchase_details WHERE purchases.id = purchase_details.purchase_id AND purchases.paid = 0) as unpaid,
                (SELECT sum(purchase_details.price) FROM purchases, purchase_details WHERE purchases.id = purchase_details.purchase_id AND purchases.due_date = CURDATE()) as due,
                (SELECT sum(purchase_details.price) FROM purchases, purchase_details WHERE purchases.id = purchase_details.purchase_id AND purchases.paid = 1) as paid")[0];

        $expenses = DB::connection('tenant')->select(
            "SELECT accounts.name, SUM(amount) as total FROM expenses JOIN accounts ON expenses.expense_account_id = accounts.id GROUP BY expense_account_id"
        );

        $invoices = Invoice::orderBy('created_at', 'desc')->whereStatus('Sent')->take(5)->get();
        $transactions = Transaction::orderBy('created_at', 'desc')->take(5)->get();
        $cash = Account::where('account_group_id', 1)->take(5)->get();
        $products = Product::take(5)->get();

        return view('home', compact('sales', 'purchases', 'expenses', 'transactions', 'cash', 'products', 'invoices'));
    }

    public function demo()
    {
        return view('auth.login', ['demo' => true]);
    }
}
