<?php
//微信服务接口
Route::any('wechat', 'WeChatController@serve');
Route::get('/user', function(){
    $user = session('wechat.oauth_user'); //一句话， 拿到授权用户资料
    dd($user);
})->middleware(['wechat.oauth']);
//施工人员工牌信息与评价
Route::get('worker/info/index','WorkerInfoController@index');