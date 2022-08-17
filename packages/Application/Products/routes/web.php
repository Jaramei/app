<?php

Route::group(['prefix'=>'application','middleware' => ['web','auth','language']], function () {

    Route::group(['prefix'=>'products','as'=>'products.'], function() {

        Route::resource('/','ProductsController',[
        ]);
        //  Route::get('products/delete/{id}', ['uses' => 'ProductsController@delete']);

        Route::resource('/categories','ProductsCategoriesController');

    });



});

