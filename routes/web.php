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
Route::delete('/transactions/{id}', 'TransactionController@destroy')->name('transactions.destroy');
Route::post('/transactions/bulk-delete', 'TransactionController@bulkDelete')->name('transactions.bulkDelete');

Route::post('/store-transaction','TransactionController@store')->name('new-transaction');
Route::post('/store-transaction-admin','TransactionController@storeAdmin')->name('new-transaction');
Route::get('user-profile','UserController@view');
Route::get('get-user/{id}','CustomerController@getUser');

Route::get('/users','EditUserController@index')->name('users');
Route::put('edit-users/{id}', 'EditUserController@update')->name('edit-users');
Route::post('/new-admin','EditUserController@store')->name('new-admin');
Route::post('admin-privillege/{id}', 'EditUserController@updatePrivilege')->name('admin.privilege.update');

Route::get('/dealers','DealerController@index')->name('dealers');
Route::post('/new-dealer','DealerController@newDealer');
Route::get('view-dealer/{id}', 'DealerController@view')->name('dealer.view');
Route::post('/change-avatar-dealer/{id}', 'DealerController@changeAvatar')->name('dealer.view');
Route::post('valid-id-dealer/{id}', 'DealerController@uploadValidId')->name('dealer.view');
Route::post('/submit-contract-dealer/{id}','DealerController@contractSign')->name('sign');
Route::get('/dashboard-dealer','DealerController@show')->name('Dealer');


Route::get('/customers','CustomerController@index')->name('customers');
Route::get('/customer','CustomerController@view')->name('customer');
Route::get('/dashboard-customer','CustomerController@show')->name('customer');
Route::get('/new-customer','CustomerController@newCustomer')->name('newcustomer');
Route::get('view-client/{id}', 'CustomerController@view')->name('client.view');
Route::post('new-customer','CustomerController@saveCustomer')->name('saveCustomer');
Route::post('/change-avatar/{id}','CustomerController@changeAvatar')->name('changeAvatar');
Route::post('/valid-id/{id}','CustomerController@uploadValidId')->name('uploadValidId');
Route::post('/submit-contract/{id}','CustomerController@contractSign')->name('sign');