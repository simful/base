<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::orderBy('name');

        if ($request->has('q')) {
            $q = $request->get('q');
            $contacts->orWhere('name', 'LIKE', "%$q%");
            $contacts->orWhere('email', 'LIKE', "%$q%");
        }

        $contacts = $contacts->paginate();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_edit = false;
        $contact = new Contact;
        return view('contacts.form', compact('contact', 'is_edit'));
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
            'email' => 'email',
        ]);

        $contact = new Contact($request->except('next'));
        $contact->save();

        if ($request->has('next')) {
            return redirect($request->get('next') . '?contact_id=' . $contact->id)
                ->with('message', trans('contact.add_success'));
        }

        return redirect('contacts')
            ->with('message', trans('contact.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contacts.show', compact('contact'));
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
        $contact = Contact::find($id);
        return view('contacts.form', compact('contact', 'is_edit'));
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
            'email' => 'email',
        ]);

        $contact = Contact::find($id);
        $contact->fill($request->except('next'));
        $contact->save();

        if (Request::has('next')) {
            return redirect(Request::get('next') . '?contact_id=' . $contact->id)
                ->with('message', trans('contact.add_success'));
        }

        return redirect('contacts')
            ->with('message', trans('contact.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return $contact;
    }
}
