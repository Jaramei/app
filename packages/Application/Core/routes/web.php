<?php

Route::group(['prefix'=>'application','middleware' => ['web','auth','language']], function () {

    Route::get('translations/{userLocale}', ['as' => 'translations.switch', 'uses' => 'LanguagesController@switchLocale']);

    Route::group(['prefix'=>'core'], function() {

    Route::get('logout', [
            'as' => 'logout',
            'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
        ]);

    Route::get('/',['as'=>'core.dashboard.index','uses'=>'DashboardController@index']);

    Route::resource('users','UsersController');
    Route::get('users/{id}/destroy',['as'=>'users.delete','uses'=>'UsersController@destroy']);

    Route::resource('packages','PackagesController');
    Route::get('packages/{id}/destroy',['as'=>'packages.delete','uses'=>'PackagesController@destroy']);


    Route::resource('languages','LanguagesController');
    Route::get('languages/{id}/destroy',['as'=>'languages.delete','uses'=>'LanguagesController@destroy']);

 });


});

