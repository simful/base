<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transaction, TransactionDetail, Account;

class TransactionController extends Controller
{
    function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->with('details')
            ->paginate(5);

        return view('transactions.index', compact('transactions'));
    }

    function create()
    {
        $isEdit = false;
        $transaction = new Transaction;
        return view('transactions.form', compact('isEdit', 'transaction'));
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $transaction = new Transaction($request->all());
        $transaction->save();

        return redirect("/transactions/$transaction->id");
    }

    function show($id)
    {
        $transaction = Transaction::find($id);
        $accounts = Account::all();

        // predict possible debit & credits to speed up form
        $totalDebit = TransactionDetail::whereTransactionId($id)->sum('debit');
        $totalCredit = TransactionDetail::whereTransactionId($id)->sum('credit');

        $predictedDebit = $totalCredit - $totalDebit > 0 ? $totalCredit - $totalDebit : 0;
        $predictedCredit = $totalDebit - $totalCredit > 0 ? $totalDebit - $totalCredit : 0;

        return view('transactions.show', compact('transaction', 'accounts', 'predictedCredit', 'predictedDebit'));
    }

    function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $transaction = Transaction::find($id);
        $transaction->fill($request->all());
        $transaction->save();

        return redirect("/transactions/$transaction->id");
    }

    function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->details()->delete();
        $transaction->delete();

        return $transaction;
    }

    function addItem(Request $request, $id)
    {
        $this->validate($request, [
			'account_id' => 'required',
            'debit' => 'required_without_all:credit',
            'credit' => 'required_without_all:debit',
        ]);

        $item = new TransactionDetail($request->all());
        $item->transaction_id = $id;
        $item->save();

        return back();
    }

    function removeItem($id)
    {
        $item = TransactionDetail::find($id);
        $item->delete();

        return $item;
    }
}
