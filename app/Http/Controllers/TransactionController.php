<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transaction;

class TransactionController extends Controller
{
    function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
            ->with(['details' => function($query) {
                $query->orderBy('credit');
            }])
            ->paginate(5);

        return view('transactions.index', compact('transactions'));
    }

    function create()
    {
        $isEdit = false;
        $transaction = new Transaction;
        return view('transactions.form', compact('isEdit', 'transaction'));
    }

    function edit($id)
    {
        $isEdit = true;
        $transaction = Transaction::find($id);
        return view('transactions.form', compact('isEdit', 'transaction'));
    }
}
