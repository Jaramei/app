<?php

Route::group(['prefix'=>'application','middleware' => ['web','auth','language']], function () {


        Route::resource('/offers','OffersController');
        Route::post('offers.sort','OffersController@sort')->name('offers.sort');
        Route::get('offers/delete/{id}', ['as' => 'offers.delete', 'uses' => 'OffersController@delete']);


 });
