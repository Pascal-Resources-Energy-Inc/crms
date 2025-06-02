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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/transactions','TransactionController@index')->name('transactions');
Route::get('/dealers','DealerController@index')->name('dealers');
Route::get('/new-dealer','DealerController@newDealer');


Route::get('/dashboard-dealer','DealerController@show')->name('Dealer');


Route::get('/customers','CustomerController@index')->name('customers');
Route::get('/customer','CustomerController@view')->name('customer');
Route::get('/dashboard-customer','CustomerController@show')->name('customer');
Route::get('/new-customer','CustomerController@newCustomer')->name('newcustomer');
Route::post('new-customer','CustomerController@saveCustomer')->name('saveCustomer');
