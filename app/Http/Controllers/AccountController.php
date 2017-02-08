<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Account;
use AccountGroup;
use TransactionDetail;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::with('group');

        if ($request->has('q')) {
            $q = $request->get('q');
            $accounts->where('name', 'LIKE', "%$q%");
        }

        $accounts = $accounts->get();

        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        $isEdit = false;
        $account = new Account();
        $accountGroups = AccountGroup::all();

        return view('accounts.form', compact('isEdit', 'account', 'accountGroups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'account_group_id' => 'required',
        ]);

        $account = Account::create($request->all());

        return redirect('/accounts');
    }

    public function show(Request $request, $id)
    {
        $account = Account::find($id);
        $transactions = TransactionDetail::with('transaction')
            ->whereAccountId($account->id)
            ->paginate(15);

        return view('accounts.show', compact('account', 'transactions'));
    }

    public function edit($id)
    {
        $isEdit = true;
        $account = Account::find($id);
        $accountGroups = AccountGroup::all();

        return view('accounts.form', compact('isEdit', 'account', 'accountGroups'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'account_group_id' => 'required',
        ]);

        $account = Account::find($id);
        $account->fill($request->all());
        $account->save();

        return redirect('/accounts');
    }

    public function destroy($id)
    {
        $account = Account::find($id);

        if ($account->editable)
        {
            $account->destroy();
            return redirect('/accounts');
        }

        return redirect('/accounts');
    }

    public function getDefaults()
    {
        $defaults = [];
        return view('accounts.defaults', compact('defaults'));
    }

    public function setDefaults(Request $request)
    {
        $defaults = [];
        return back();
    }
}
