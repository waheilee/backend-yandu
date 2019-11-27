<?php
//Route::get('logout','Auth\LoginController@');
Route::group(['middleware' => ['auth:admin']], function () {


    Route::get('home', 'IndexController@index')->name('home');
    //我要派单，发布项目，项目需求
    Route::get('project/index', 'ProjectController@index')->name('project.index');
    Route::get('project/create', 'ProjectController@store')->name('project.store');
    Route::post('project/create', 'ProjectController@store')->name('project.store');
    Route::post('project/delete', 'ProjectController@delete')->name('project.delete');
    Route::get('project/list', 'ProjectController@indexRequest')->name('project.indexRequest');
    Route::get('project/intention', 'IntentionController@index')->name('project.intention');
    Route::get('project/intention/list', 'IntentionController@indexRequest')->name('project.intention.indexRequest');
    Route::post('project/intention/partner', 'IntentionController@partner')->name('project.intention.partner');
    Route::post('project/intention/check', 'IntentionController@check')->name('project.intention.check');

    Route::get('demand/index','DemandController@index')->name('demand.index');
    Route::get('demand/list','DemandController@indexRequest')->name('demand.indexRequest');

    Route::get('demand/join/index','JoinController@index')->name('demand.join.index');
    Route::get('demand/join/list','JoinController@indexRequest')->name('demand.join.indexRequest');

    Route::get('demand/partner/index','PartnerController@index')->name('demand.partner.index');
    Route::get('demand/partner/list','PartnerController@indexRequest')->name('demand.partner.indexRequest');
    Route::post('demand/partner/check','PartnerController@check')->name('demand.partner.check');

    Route::get('worker/index','WorkerController@index')->name('worker.index');
    Route::get('worker/list','WorkerController@indexRequest')->name('worker.indexRequest');
    Route::get('worker/create','WorkerController@create')->name('worker.create');
    Route::post('worker/store','WorkerController@store')->name('worker.store');
    Route::post('worker/image/upload','WorkerController@image');

    //评价
    Route::get('evaluate','EvaluateController@index');
    Route::get('evaluate/project_side','EvaluateController@ProjectSide');
    Route::post('evaluate/merchant/project_side','EvaluateController@evaluateProjectSide');
    Route::post('evaluate/project_side/merchant','EvaluateController@evaluateMerchant');
});



