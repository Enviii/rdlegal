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
    return redirect()->action(
        'SummaryController@index'
    );
});

Route::resource('summary', 'SummaryController');
Route::resource('transaction', 'TransactionController');
Route::post('transaction', "TransactionController@getNegativeTransaction");
