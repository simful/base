<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    function index()
	{
        $user = Auth::user();
		return view('profile.view', compact('user'));
	}

    function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        return redirect('profile');
    }
}
