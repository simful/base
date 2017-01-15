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

Route::get('/', function () {
    if (Auth::check())
        return redirect('home');
    else
        return redirect('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index');

    Route::post('invoices/add-item/{id}', 'InvoicesController@addItem');
    Route::post('invoices/remove-item/{id}', 'InvoicesController@removeItem');
    Route::any('invoices/{id}/process', 'InvoicesController@process');
    Route::get('invoices/email/{id}', 'InvoiceController@email');
    Route::get('invoices/receipt/{id}', 'InvoiceController@receipt');
    Route::resource('invoices', 'InvoicesController');

    Route::post('purchases/add-item/{id}', 'PurchaseController@addItem');
    Route::post('purchases/remove-item/{id}', 'PurchaseController@removeItem');
    Route::any('purchases/{id}/process', 'PurchaseController@process');
    Route::resource('purchases', 'PurchaseController');

    Route::resource('contacts', 'ContactsController');
    Route::post('transactions/add-item/{id}', 'TransactionController@addItem');
    Route::post('transactions/remove-item/{id}', 'TransactionController@removeItem');
    Route::resource('transactions', 'TransactionController');
    Route::resource('accounts', 'AccountController');
    Route::resource('products', 'ProductsController');
    Route::post('products/{id}/upload', 'ProductsController@upload');
    Route::resource('taxes', 'TaxesController');

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::put('profile', 'ProfileController@update');

    Route::get('settings/company', 'CompanyController@edit');
    Route::post('settings/company', 'CompanyController@update');
    Route::post('settings/upload-logo', 'SettingsController@uploadLogo');
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
