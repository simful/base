<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Expense;
use Account, Transaction, TransactionDetail;
use Auth;

class ExpensesController extends Controller
{
    public function index()
	{
        $expenses = Expense::orderBy('created_at', 'desc')
            ->paginate(15);
		return view('expenses.index', compact('expenses'));
	}

    public function create()
    {
        $is_edit = false;
        $expense = new Expense;
        $source_accounts = Account::whereAccountGroupId(1)->get();
        $expense_accounts = Account::whereAccountGroupId(9)->get();
        return view('expenses.form', compact('expense', 'source_accounts', 'expense_accounts', 'is_edit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'source_account_id' => 'numeric',
            'expense_account_id' => 'numeric',
            'amount' => 'required|numeric',
        ]);

        $expense = new Expense($request->all());
        $expense->user_id = Auth::id();
        $expense->save();

        return redirect('expenses');
    }

    public function edit($id)
    {
        $is_edit = true;
        $expense = Expense::find($id);
        $source_accounts = Account::whereAccountGroupId(1)->get();
        $expense_accounts = Account::whereAccountGroupId(9)->get();
        return view('expenses.form', compact('expense', 'source_accounts', 'expense_accounts', 'is_edit'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'source_account_id' => 'numeric',
            'expense_account_id' => 'numeric',
            'amount' => 'required|numeric',
        ]);

        $expense = Expense::find($id);
        $expense->fill($request->all());
        $expense->save();

        return redirect('expenses');
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return $expense;
    }

    public function process($id)
    {
        // post to journal
        $expense = Expense::find($id);

        return $expense->postToJournal();
    }
}
