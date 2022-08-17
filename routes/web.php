<?php


    Route::group(['prefix'=>'{lang?}','middleware' => ['web','frontend','locale']], function () {

        Route::get('/', function () {

            return view('welcome');

        });

    });


    Route::group(['prefix'=>'auth','middleware' => ['web']], function () {

    Auth::routes();

    });


    Route::get('/home', 'HomeController@index')->name('home');

