<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('test', function() {
    $invoice = Invoice::first();
    $agent = Agent::first();
    return view('invoices.receipt', compact('invoice', 'agent'));
});

Route::get('testr', function() {
    $invoice = Invoice::first();
    $agent = Agent::first();
    return view('invoices.email', compact('invoice', 'agent'));
});

Route::get('/', function () {
    if (Auth::check())
        return redirect('home');
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index');

    Route::post('invoices/add-item/{id}', 'InvoicesController@addItem');
    Route::post('invoices/remove-item/{id}', 'InvoicesController@removeItem');
    Route::resource('invoices', 'InvoicesController');

    Route::post('purchases/add-item/{id}', 'PurchaseController@addItem');
    Route::post('purchases/remove-item/{id}', 'PurchaseController@removeItem');
    Route::resource('purchases', 'PurchaseController');

    Route::resource('customers', 'CustomersController');
    Route::resource('transactions', 'TransactionController');
    Route::resource('accounts', 'AccountController');
    Route::resource('products', 'ProductsController');
    Route::resource('taxes', 'TaxesController');

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::put('profile', 'ProfileController@update');

    Route::get('settings/{page?}', 'SettingsController@index');
    Route::post('settings', 'SettingsController@save');

    Route::resource('expenses', 'ExpensesController');
    Route::get('stock', 'StockController@index');

    Route::get('reports/sales', 'ReportController@sales');
    Route::get('reports/purchase', 'ReportController@purchase');
    Route::get('reports/stock', 'ReportController@stock');
    Route::get('reports/receivables', 'ReportController@receivables');
    Route::get('reports/payables', 'ReportController@payables');
    Route::get('reports/income-statement', 'ReportController@incomeStatement');
    Route::get('reports/trial-balance', 'ReportController@trialBalance');

    Route::resource('users', 'UsersController');
});
