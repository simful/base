<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Contact, Product;
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
        $purchase = Invoice::find($id);
        $purchase->delete();
        return $purchase;
    }

	public function addItem(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $item = new PurchaseDetail($request->all());
        $item->purchase_id = $id;
        $item->save();

        return back();

        $purchase = Purchase::find($id);
        $purchase->details()->create($request->all());
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

		// add transaction journal
		$transaction = new Transaction;
		$transaction->description = "Purchase Order #$id";
		$transaction->user_id = Auth::id();
		$transaction->save();

		// we need 2 parameters:
		// source account (default: cash)
		// destination account (default: deposit)

		$details = [
            new TransactionDetail([
                'account_id' => 1010, // asset
                'debit' => $this->total[0]->price,
                'credit' => 0
            ]),
            new TransactionDetail([
                'account_id' => 7010, // penjualan
                'debit' => 0,
                'credit' => $this->total[0]->price
            ])
        ];

        $transaction->details()->saveMany($details);


		// update stock now

		foreach ($purchase->details as $item)
		{
			$product = Product::find($item->product_id);

			if ($product == null) // create new
			{
				$product = new Product([
					'name' => $item->description,
					'buy_price' => $item->price,
					'stock' => $item->qty,
				]);
			}
			else
			{
				$product->stock += $item->qty;
			}

			$product->save();
		}

        return $transaction;
    }


}
