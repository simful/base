<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Product, Auth, StockHistory;

class StockController extends Controller
{
    public function index()
	{
		$products = Product::orderBy('name')->get();
		return view('stock.index', compact('products'));
	}

    public function show($id)
    {
        $product = Product::find($id);
        return view('stock.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('stock.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'stock' => 'required|integer'
        ]);

        // add to stock history
        $product = Product::find($id);

        // determine stock larger or smaller
        $oldStock = $product->stock;

        if (strlen($request->reason) < 1)
        {
            $request->reason = 'Update stock';
        }

        if ($product->stock != $request->stock)
        {
            $product->stock = $request->stock;
            $product->save();

            StockHistory::create([
                'in' => $product->stock > $oldStock ? $product->stock - $oldStock : 0,
                'out' => $product->stock < $oldStock ? $oldStock - $product->stock : 0,
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'description' => $request->reason
            ]);
        }

        return redirect('stock');
    }
}
