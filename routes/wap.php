<?php
//微信服务接口
Route::any('wechat', 'WeChatController@serve');

Route::group(['middleware' => ['wap']],function (){
    //施工人员工牌信息与评价
    Route::get('worker/info/index','WorkerInfoController@index')->middleware(['wechat.oauth']);
    Route::get('worker/info/evaluate/{id}','WorkerInfoController@evaluate');
    Route::post('worker/info/store/evaluate','WorkerInfoController@storeEvaluate')->name('storeEvaluate');
    Route::get('worker/info/evaluate/test/ajax','WorkerInfoController@dataAjax');

});

/**
 * 西牛涂料工人管理
 */
Route::get('se_new/login','SeNewLoginController@showLogin');//登录
Route::post('se_new/login','SeNewLoginController@login');//登录
Route::get('se_new/register','SeNewRegisterController@showRegistrationForm');//注册页
Route::post('se_new/register/create','SeNewRegisterController@register');//提交注册信息
Route::group(['middleware' => ['se-new:work']],function () {
    Route::get('se_new/worker_center','SeNewWorkerCenterController@index');//施工人员个人中心
    Route::get('se_new/worker/edit/{id}','SeNewWorkerCenterController@edit');//施工人员信息编辑
    Route::post('se_new/worker/update','SeNewWorkerCenterController@update');//施工人员信息更新
    Route::post('se_new/worker/avatar/edit','SeNewWorkerCenterController@avatarEdit');//编辑头像
    Route::get('se_new/worker/evaluate','SeNewEvaluateController@index');//施工人员评价
    Route::post('se_new/worker/evaluate/create','SeNewEvaluateController@store');//施工人员评价

});
