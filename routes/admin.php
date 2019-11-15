<?php
//Route::get('logout','Auth\LoginController@');
Route::group(['middleware' => ['auth:admin']], function () {


    Route::get('home', 'IndexController@index')->name('home');
    //我要派单，发布项目，项目需求
    Route::get('project/index', 'ProjectController@index')->name('project.index');
    Route::get('project/create', 'ProjectController@store')->name('project.store');
    Route::post('project/create', 'ProjectController@store')->name('project.store');
    Route::get('project/list', 'ProjectController@indexRequest')->name('project.indexRequest');
    Route::get('project/intention', 'IntentionController@index')->name('project.intention');
    Route::get('project/intention/list', 'IntentionController@indexRequest')->name('project.intention.indexRequest');
    Route::post('project/intention/partner', 'IntentionController@partner')->name('project.intention.partner');

    Route::get('demand/index','DemandController@index')->name('demand.index');
    Route::get('demand/list','DemandController@indexRequest')->name('demand.indexRequest');

    Route::get('demand/join/index','JoinController@index')->name('demand.join.index');
    Route::get('demand/join/list','JoinController@indexRequest')->name('demand.join.indexRequest');

    Route::get('demand/partner/index','PartnerController@index')->name('demand.partner.index');
    Route::get('demand/partner/list','PartnerController@indexRequest')->name('demand.partner.indexRequest');
    Route::post('demand/partner/check','PartnerController@check')->name('demand.partner.check');

});



