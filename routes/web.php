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

Route::get('detail/{id}','Web\DetailController@index');
Route::post('web/merchants/info','Web\DetailController@getMerchantInfo')->name('info');
Route::post('web/merchants/intention','Web\DetailController@intention')->name('intention');

Auth::routes();

