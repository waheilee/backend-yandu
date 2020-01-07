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

Route::get('worker/info/index/test','WorkerInfoController@index');
//Route::get('worker/info/evaluate/test/inn','WorkerInfoController@test');