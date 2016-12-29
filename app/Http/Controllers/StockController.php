<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Product;

class StockController extends Controller
{
    public function index()
	{
		$products = Product::orderBy('name')->get();
		return view('stock.index', compact('products'));
	}
}
