<?php
use App\Http\Controllers\Admin\PolicyController;
//Route::get('logout','Auth\LoginController@');
Route::group(['middleware' => ['auth:admin']], function () {


    Route::get('home', 'IndexController@index')->name('home');
    //我要派单，发布项目，项目需求
    Route::get('project/index', 'ProjectController@index')->name('project.index');
    Route::get('project/create', 'ProjectController@create')->name('project.create');
    Route::post('project/create', 'ProjectController@store')->name('project.store');
    Route::get('project/edit', 'ProjectController@edit')->name('project.edit');
    Route::post('project/edit', 'ProjectController@update')->name('project.update');
    Route::post('project/delete', 'ProjectController@delete')->name('project.delete');
    Route::get('project/list', 'ProjectController@indexRequest')->name('project.indexRequest');
    Route::get('project/intention', 'IntentionController@index')->name('project.intention');
    Route::get('project/intention/list', 'IntentionController@indexRequest')->name('project.intention.indexRequest');
    Route::post('project/intention/partner', 'IntentionController@partner')->name('project.intention.partner');
    Route::post('project/intention/check', 'IntentionController@check')->name('project.intention.check');
    Route::post('project/intention/confirm_check', 'IntentionController@confirm')->name('project.intention.confirm_check');
    Route::post('project/intention/download/check','IntentionController@download')->name('project.intention.download');


    Route::get('demand/index','DemandController@index')->name('demand.index');
    Route::get('demand/list','DemandController@indexRequest')->name('demand.indexRequest');

    Route::get('demand/join/index','JoinController@index')->name('demand.join.index');
    Route::get('demand/join/list','JoinController@indexRequest')->name('demand.join.indexRequest');
    Route::post('demand/join/check','JoinController@check')->name('demand.join.check');
    Route::post('demand/join/confirm_check','JoinController@confirm')->name('demand.join.confirm_check');
    Route::post('demand/join/download/check','JoinController@download')->name('demand.join.download');


    Route::get('demand/partner/index','PartnerController@index')->name('demand.partner.index');
    Route::get('demand/partner/list','PartnerController@indexRequest')->name('demand.partner.indexRequest');
    Route::post('demand/partner/check','PartnerController@check')->name('demand.partner.check');
    Route::post('demand/partner/confirm_check','PartnerController@confirm')->name('demand.partner.confirm_check');

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

    //保单
    Route::get('policies/index', 'PolicyController@index')->name('policy.index');
    Route::get('policies/list', 'PolicyController@indexRequest')->name('policy.indexRequest');
    Route::post('policies/create', 'PolicyController@store')->name('policy.create');
    Route::post('policies/edit', 'PolicyController@edit')->name('policy.edit');
    Route::post('policies/update', 'PolicyController@update')->name('policy.update');
    Route::post('policies/delete', 'PolicyController@delete')->name('policy.delete');

    Route::get('policy_show/{id}', 'PolicyShowController@index')->name('policy.show');
    Route::get('policy_show/show/list', 'PolicyShowController@showRequest')->name('policy.showList');

    //雇主责任险
    Route::get('policies/employer/index', 'PolicyEmployerController@index')->name('employer.index');
    Route::get('policies/employer/list', 'PolicyEmployerController@indexRequest')->name('employer.list');
    Route::post('policies/employer/renew_pay', 'PolicyEmployerController@renewPay')->name('employer.renewPay');


    Route::get('merchant', 'MerchantController@index')->name('merchant.index');
    Route::post('merchant/edit_intro', 'MerchantController@updateIntro')->name('merchant.edit_intro');

    Route::get('news_detail','DetailController@newsDetail')->name('news_detail');
    Route::get('service_detail','DetailController@serviceDetail')->name('service_detail');

});


//Route::get('project/intention/refund/{id}', 'IntentionController@refund');
