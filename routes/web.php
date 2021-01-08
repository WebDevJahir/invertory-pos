<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::resource('users', 'UserController');

Route::resource('customers', 'CustomerController');

Route::resource('suppliers', 'SupplierController');

Route::resource('units', 'UnitController');

Route::resource('categories', 'CategoryController');

Route::resource('products', 'ProductController');

Route::resource('perchases', 'PerchaseController');

Route::get('perchases/approved/{id}','PerchaseController@approved');

Route::get('/get-category','DefaultController@getCategory');

Route::get('/get-product','DefaultController@getProduct');
Route::get('product/stock/{id}','ProductController@productStock');

Route::get('/get/stock','InvoiceController@getStock');

Route::resource('invoices', 'InvoiceController');

Route::get('invoice/approved/{id}', 'InvoiceController@approved');
Route::post('confirm/approve/{id}', 'InvoiceController@comfirmApprove');
Route::get('/print/{id}', 'InvoiceController@printInvoice');
Route::match(['get','post'],'/daily-report','InvoiceController@dailyReport');
Route::match(['get','post'],'/daily-perchase-report','PerchaseController@dailyReport');
Route::match(['get','post'],'/stock','StockController@stockReport');
Route::get('/remove-product','InvoiceController@removeProduct');