<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Product, Auth, StockHistory;
use Invoice, Purchase;

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


        }

        return redirect('stock');
    }

    public function updateFromSales(Request $request, $id)
    {
        // ambil invoice
        $invoice = Invoice::find($id);

        // cari detail item, kemudian update
        foreach ($invoice->details as $item) {
            if ($item->product_id) { // && $item->product) {
                Product::updateStock();
            }
        }
    }

    public function updateFromPurchase(Request $request, $id)
    {

    }
}
