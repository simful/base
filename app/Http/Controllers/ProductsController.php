<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Product;
use Image;
use Auth;
use File, Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('name');

        if ($request->has('q')) {
            $q = $request->get('q');
            $products->orWhere('name', 'LIKE', "%$q%");
            $products->orWhere('description', 'LIKE', "%$q%");
        }

        $products = $products->paginate(5);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $is_edit = false;
        $product = new Product();

        return view('products.form', compact('product', 'is_edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);

        $product = new Product($request->except('picture'));
        $product->save();

        if ($request->has('picture')) {
            $this->upload($request, $product->id);
        }

        return redirect('products')
            ->with('message', trans('product.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $is_edit = true;
        $product = Product::find($id);

        return view('products.form', compact('product', 'is_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->fill($request->except('picture'));
        $product->save();

        if ($request->has('picture')) {
            $this->upload($request, $id);
        }

        return redirect('products')
            ->with('message', trans('product.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return $product;
    }

    public function upload(Request $request, $id)
    {
        // default values:
        $defaults = [
            'shape' => 'square',
        ];

        if (!File::exists(public_path('img/products'))) {
            mkdir(public_path('img/products'));
        }

        if (!File::exists(public_path('img/products/'.Auth::user()->agent_id))) {
            mkdir(public_path('img/products/'.Auth::user()->agent_id));
        }

        Image::make($request->file('picture'))
            ->resize(null, 512, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
            ->save(public_path('img/products').'/'.Auth::user()->agent_id.'/'.$id.'.jpg');

        return redirect()->back();
    }
}
