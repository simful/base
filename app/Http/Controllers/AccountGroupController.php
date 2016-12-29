<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountGroupController extends Controller
{
	function index()
    {
        $accountGroups = AccountGroup::all();

        return view('accounts.index', compact('accounts'));
    }
}
