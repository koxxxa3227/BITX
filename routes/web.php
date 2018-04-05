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

Route::get('/home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/feedback', 'HomeController@feedback');

Route::view('/faq', "faq");
Route::view('/confidence', 'confidence');
Route::view('/rules', 'rules');

Route::view('404', '404');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function(){
    Route::get('/', 'Admin\PageController@index');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function(){
    Route::get('/deposit', 'Profile\PageController@deposit');
    Route::get('/payments', 'Profile\PageController@payments');
    Route::get('/cabinet', 'Profile\PageController@cabinet');
    Route::get('/refs', 'Profile\PageController@refs');
});