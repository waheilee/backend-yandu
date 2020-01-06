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
   return redirect('login') ;
});

Route::get('detail/{id}','Web\DetailController@index');
Route::post('web/merchants/info','Web\DetailController@merchantInfo')->name('info');
Route::post('web/merchants/intention','Web\DetailController@intention')->name('intention');
Route::get('web/merchants/intention','Web\DetailController@intention')->name('intention');
Route::post('web/pay_notify','Web\DetailController@notify')->name('notify');
Route::get('alipay/{id}','Web\AlipayController@Alipay')->name('alipay');
Route::get('wechat/refund/{orderNum}','Web\WeChatPayController@refund')->name('wechat.refund');
Route::post('wechat/refund/query_order','Web\WeChatPayController@queryRefund')->name('wechat.queryRefund');
Route::post('ailipay/refund/query_order','Web\AlipayController@queryRefund')->name('alipay.queryRefund');

//填写保单页面
Route::get('policy/{id}','Web\PolicyController@index')->name('policy');
Route::get('policy/store/create/{id}','Web\PolicyController@create');
Route::post('policy/store','Web\PolicyController@store')->name('policy.store');

//雇主责任险保单填写
Route::get('policy/employer/detail','Web\PolicyEmployerController@index')->name('employer');
Route::post('policy/employer/create','Web\PolicyEmployerController@store')->name('employer.store');
Route::get('policy/employer/pay/{id}','Web\PolicyEmployerController@pay')->name('employer.pay');
Route::post('policy/employer/wechat_pay','Web\PolicyEmployerController@wechatPay')->name('employer.wechatPay');
//Route::post('policy/employer/ali_pay','Web\PolicyEmployerController@aliPay')->name('employer.aliPay');

Auth::routes();

