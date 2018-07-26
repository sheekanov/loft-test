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



Auth::routes();

Route::group(['prefix' => '', 'middleware' => 'registered'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/request', 'UserRequestController@index')->name('request');
    Route::post('/request', 'UserRequestController@store')->name('request.store');

    Route::group(['prefix' => 'manager', 'middleware' => 'manager'], function() {
        Route::get('/', 'ManagerController@index')->name('manager');
        Route::post('/updateEmail', 'ManagerController@updateEmail')->name('manager.updateEmail');
        Route::post('/processRequests', 'ManagerController@processRequests')->name('manager.processRequests');
    });

});

