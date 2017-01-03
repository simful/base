<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User, Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_edit = false;
        $user = new User;
        return view('users.form', compact('user', 'is_edit'));
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
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = new User($request->except('password', 'verify_password'));

        if ($request->has('password') && strlen($request->get('password')) > 5)
        {
            if ($request->get('password') == $request->get('verify_password'))
            {
                $user->password = Hash::make($request->get('password'));
            }
            else
            {
                return back()->with('message', 'New password and verify password did not match.');
            }
        }
        else
        {
            return back()->with('message', 'Password length must be 6 or more characters.');
        }

        $user->save();

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $user = User::find($id);
        return view('users.form', compact('user', 'is_edit'));
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
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);
        $user->fill($request->except('password', 'verify_password'));

        if ($request->has('password') && strlen($request->get('password')) > 5)
        {
            if ($request->get('password') == $request->get('verify_password'))
            {
                $user->password = Hash::make($request->get('password'));
            }
            else
            {
                return back()->with('message', 'New password and verify password did not match.');
            }
        }
        else
        {
            return back()->with('message', 'Password length must be 6 or more characters.');
        }

        $user->save();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return $user;
    }
}
