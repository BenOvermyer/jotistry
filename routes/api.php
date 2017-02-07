<?php

Route::group( [ 'middleware' => 'auth:api' ], function () {
    Route::group( [ 'prefix' => 'notes' ], function () {
        Route::get( '/', [ 'as' => 'notes.api.index', 'uses' => 'NotesAPIController@index' ] );
        Route::get( '/{id}', [ 'as' => 'notes.api.show', 'uses' => 'NotesAPIController@show' ] );
        Route::post( '/', [ 'as' => 'notes.api.save', 'uses' => 'NotesAPIController@save' ] );
        Route::post( '/{id}', [ 'as' => 'notes.api.update', 'uses' => 'NotesAPIController@update' ] );
        Route::delete( '/{id}', [ 'as' => 'notes.api.destroy', 'uses' => 'NotesAPIController@destroy' ] );
    } );

    Route::group( [ 'prefix' => 'taskCategories' ], function () {
        Route::get( '/', [ 'as' => 'taskCategories.api.index', 'uses' => 'TaskCategoriesAPIController@index' ] );
        Route::get( '/{id}', [ 'as' => 'taskCategories.api.show', 'uses' => 'TaskCategoriesAPIController@show' ] );
        Route::post( '/', [ 'as' => 'taskCategories.api.save', 'uses' => 'TaskCategoriesAPIController@save' ] );
        Route::post( '/{id}', [ 'as' => 'taskCategories.api.update', 'uses' => 'TaskCategoriesAPIController@update' ] );
        Route::delete( '/{id}', [ 'as' => 'taskCategories.api.destroy', 'uses' => 'TaskCategoriesAPIController@destroy' ] );
    } );

    Route::group( [ 'prefix' => 'tasks' ], function () {
        Route::get( '/', [ 'as' => 'tasks.api.index', 'uses' => 'TasksAPIController@index' ] );
        Route::get( '/byCategory/{id}', [ 'as' => 'tasks.api.byCategory', 'uses' => 'TasksAPIController@byCategory' ] );
        Route::get( '/{id}', [ 'as' => 'tasks.api.show', 'uses' => 'TasksAPIController@show' ] );
        Route::post( '/', [ 'as' => 'tasks.api.save', 'uses' => 'TasksAPIController@save' ] );
        Route::post( '/{id}', [ 'as' => 'tasks.api.update', 'uses' => 'TasksAPIController@update' ] );
        Route::delete( '/{id}', [ 'as' => 'tasks.api.destroy', 'uses' => 'TasksAPIController@destroy' ] );
    } );
} );