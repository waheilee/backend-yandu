<?php
//Route::get('logout','Auth\LoginController@');
Route::group(['middleware' => ['auth:admin']], function () {


    Route::get('home', 'IndexController@index')->name('home');
    Route::get('project', 'ProjectController@index')->name('project.list');
    Route::get('project/create', 'ProjectController@store')->name('project.store');
    Route::post('project/create', 'ProjectController@store')->name('project.store');
});



