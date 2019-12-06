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
    redirect('/login') ;
});

Route::get('detail/{id}','Web\DetailController@index');
Route::post('web/merchants/info','Web\DetailController@merchantInfo')->name('info');
Route::post('web/merchants/intention','Web\DetailController@intention')->name('intention');
Route::get('web/merchants/intention','Web\DetailController@intention')->name('intention');
Route::post('web/pay_notify','Web\DetailController@notify')->name('notify');
Route::get('alipay/{id}','Web\AlipayController@Alipay')->name('alipay');

Auth::routes();

