<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

//ユーザー登録
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');


// ログイン認証
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');


// ログイン認証後のユーザー機能
Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);

    //ユーザーのフォロー・アンフォロー機能
    Route::group(['prefix' => 'users/{id}'], function () { 
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });

    //お気に入り機能
    Route::group(['prefix' => 'users/{id}'], function () { 
        Route::post('favor', 'FavoriteController@store')->name('user.favor');
        Route::delete('unfavor', 'FavoriteController@destroy')->name('user.unfavor');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
        Route::get('favored', 'UsersController@favored')->name('microposts.favored');
    });



    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});