<?php

Route::group( [ 'middleware' => 'logged_in' ], function() {
    Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index' ] );

    // Authentication routes
    Route::get( 'auth/login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@getLogin' ] );
    Route::post( 'auth/login', [ 'as' => 'doLogin', 'uses' => 'Auth\AuthController@postLogin' ] );
    Route::get( 'auth/logout', [ 'as' => 'doLogout', 'uses' => 'Auth\AuthController@getLogout' ] );

    Route::group( [ 'middleware' => 'auth' ], function() {
        Route::get( 'dashboard', [ 'as' => 'dashboard', 'uses' => 'HomeController@dashboard' ] );    
    });    
});