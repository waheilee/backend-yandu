<?php
//微信服务接口
Route::any('wechat', 'WeChatController@serve');

Route::group(['middleware' => ['auth:wap']],function (){
    //施工人员工牌信息与评价
    Route::get('worker/info/index','WorkerInfoController@index')->middleware(['wechat.oauth']);
});

