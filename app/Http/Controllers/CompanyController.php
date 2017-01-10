<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Agent;

class CompanyController extends Controller
{
    public function edit()
	{
		$company = Agent::find(Auth::user()->agent_id);
		return view('company.form', compact('company'));
	}

	public function update(Request $request)
	{
		$company = Agent::find(Auth::user()->agent_id);
		$company->fill($request->all());
		$company->save();

		return back()->with('message', 'Changes saved.');
	}
}
