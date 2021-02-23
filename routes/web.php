<?php

use Illuminate\Support\Facades\Route;

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

// Get
Route::get('/', 'LoginController@index');
Route::get('/home', 'HomeController@index');
Route::get('/logout', 'HomeController@logout');
Route::get('/order/list', 'OrderController@list');
Route::get('/order/{order_id}', 'OrderController@detail');
Route::get('/order/create', 'OrderController@create');
Route::get('/customer/list', 'CustomerController@list');
Route::get('/customer/{customer_id}', 'CustomerController@detail');
Route::get('/customer/list/search', 'CustomerController@search');
Route::get('/analytics', 'AnalyticsController@index');

// Post
Route::post('/auth', 'LoginController@auth');
Route::post('/order', 'OrderController@store');
Route::post('/order/export', 'OrderController@export');
Route::post('/customer/edit/{customer_id}/{yayoi_sales_id}', 'CustomerController@edit');
Route::post('/customer/create/{customer_id}', 'CustomerController@create');
// import作業が終わったら削除
Route::post('/customer/csv', 'CustomerController@csv');
