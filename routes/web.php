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

//Route::post('/', 'OrderController@subscribe')->name("route.subscribe");
Route::get('/', 'OrderController@index')->name("home");
Route::get('/test', 'TestController@index');
Route::post('test', 'TestController@create');
Route::post('test/filters', 'TestController@filters');
Route::post('test/selected', 'TestController@selected');
Route::post('test/excludes', 'TestController@excludes');
Route::post('test/counters', 'TestController@counters');
Route::get('test/confirm', 'TestController@confirm');
Route::post('test/confirm', 'TestController@store');
Route::get('test/{id}/nix-validation', 'TestController@nixValidation');
Route::get('test/{id}/download', 'TestController@download');

Route::post('orders', 'OrderController@create');
Route::post('orders/filters', 'OrderController@filters');
Route::post('orders/selected', 'OrderController@selected');
Route::post('orders/excludes', 'OrderController@excludes');
Route::post('orders/counters', 'OrderController@counters');

Route::get('orders/addressConfirm', 'OrderController@addressConfirm');
Route::get('orders/confirm', 'OrderController@confirm');
Route::post('orders/confirm', 'OrderController@store');
Route::get('orders/{id}/nix-validation', 'OrderController@nixValidation');
Route::get('orders/{id}/download', 'OrderController@download');

Route::get('thanks', function () { return view('thanks'); });
Route::get('oops', function () { return view('oops'); });

Route::get('payments/{id}/payson', 'PaysonController@create');
Route::get('payments/{id}/billmate', 'BillmateController@index');
Route::get('payments/{id}/stripe', 'StripeController@index');
Route::post('payments/{id}/stripe', 'StripeController@stripePost')->name('stripe.post');;

Route::get('payson/{id}/confirm', 'PaysonController@confirm');
Route::any('payson/{id}/notify', 'PaysonController@notify');
Route::get('payson/{id}/cancel', 'PaysonController@cancel');

Route::get('transactions/{id}', 'TransactionController@create');

//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {

    Route::get('/', 'AdminController@index');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('users', 'UsersController');
    Route::resource('settings', 'SettingsController');
    Route::get('addresses/import', 'AddressesController@importView');
    Route::post('addresses/import', 'AddressesController@import');
    Route::resource('addresses', 'AddressesController');
    Route::resource('discounts', 'DiscountsController');
    Route::resource('orders', 'OrdersController');
    Route::post('orders/{id}/store-export-data', 'OrdersController@storeExportData');
    Route::post('orders/{id}/email', 'OrdersController@email');
    Route::post('orders/{id}/download', 'OrdersController@download');
    Route::resource('prices', 'PricesController');
    Route::resource('pages', 'PagesController');

    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});

Route::get('{name}', 'PageController@show');
