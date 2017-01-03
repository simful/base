<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tax;

class TaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxes = Tax::orderBy('name');

        if ($request->has('q')) {
            $q = $request->get('q');
            $taxes->orWhere('name', 'LIKE', "%$q%");
            $taxes->orWhere('description', 'LIKE', "%$q%");
            $taxes->orWhere('price', 'LIKE', "%$q%");
        }

        $taxes = $taxes->paginate(10);
        return view('taxes.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_edit = false;
        $tax = new Tax;
        return view('taxes.form', compact('tax', 'is_edit'));
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
            'code' => 'required',
            'rate' => 'required|numeric'
        ]);

        $tax = new Tax($request->all());
        $tax->save();

        return redirect('taxes')
            ->with('message', trans('tax.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tax = Tax::find($id);
        return $tax;
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
        $tax = Tax::find($id);
        return view('taxes.form', compact('tax', 'is_edit'));
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
            'code' => 'required',
            'rate' => 'required|numeric'
        ]);

        $tax = Tax::find($id);
        $tax->fill($request->all());
        $tax->save();

        return redirect('taxes')
            ->with('message', trans('tax.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = Tax::find($id);
        $tax->delete();

        return $tax;
    }
}
