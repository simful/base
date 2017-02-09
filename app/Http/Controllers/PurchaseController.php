<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Contact, Product, Transaction, TransactionDetail;
use Purchase, PurchaseDetail;
use Auth;

class PurchaseController extends Controller
{
	public function index()
	{
		$purchases = Purchase::paginate();
		return view('purchase.index', compact('purchases'));
	}

    public function create()
	{
		$is_edit = false;
		$purchase = new Purchase;
		$suppliers = Contact::orderBy('name')->get();
		return view('purchase.form', compact('purchase', 'suppliers', 'is_edit'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'supplier_id' => 'required|numeric'
		]);

		$purchase = new Purchase($request->all());
		$purchase->user_id = Auth::id();
		$purchase->save();

		return redirect('purchases/' . $purchase->id);
	}

	public function show($id)
	{
		$purchase = Purchase::find($id);
		$products = Product::orderBy('name')->get();

		return view('purchase.show', compact('purchase', 'products'));
	}

	public function edit($id)
	{
		$is_edit = true;
		$purchase = Purchase::find($id);
		$suppliers = Contact::orderBy('name')->get();
		return view('purchase.form', compact('purchase', 'suppliers', 'is_edit'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'supplier_id' => 'required|numeric'
		]);

		$purchase = Purchase::find($id);
		$purchase->fill($request->all());
		$purchase->save();

		return redirect('purchases/' . $purchase->id);
	}

	public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();
        return $purchase;
    }

	public function addItem(Request $request, $id)
    {
        $this->validate($request, [
			'product_id' => 'required_without_all:description',
            'description' => 'required_without_all:product_id',
            'qty' => 'required|numeric',
            'price' => 'numeric',
        ]);

		$item = PurchaseDetail::wherePurchaseId($id)->whereProductId($request->product_id)->first();

		if ($item) {
			$item->qty += $request->qty;
		} else {
			$item = new PurchaseDetail($request->all());
			$item->purchase_id = $id;

			if ($request->product_id) {
				$item->price = $request->price > 0 ? $request->price : Product::find($request->product_id)->buy_price;
			}
		}

        $item->save();

        return back();
    }

    public function removeItem($id)
    {
        $item = PurchaseDetail::find($id);
        $item->delete();

        return $item;
    }

	public function process(Request $request, $id)
    {
		$purchase = Purchase::find($id);

		if (count($purchase->details) && $purchase->status == 'Draft')
		{
			$purchase->process();
		}

		return $purchase;
    }


}
