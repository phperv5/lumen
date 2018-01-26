<?php

Route::group(['namespace' => 'Main', 'middleware' => ['web']], function () {

    Route::get('/', ['as' => 'homepage', 'uses' => 'HomeController@index']);

});


Route::group(['namespace' => 'Wechat', 'middleware' => [], 'prefix' => 'wechat'], function () {
    Route::get('auth', ['as' => 'auth', 'uses' => 'AuthController@index']);
    Route::post('payment', ['as' => 'payment', 'uses' => 'PaymentController@index']);
});