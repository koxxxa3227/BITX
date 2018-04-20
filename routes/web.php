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

Route::get('/home', function () { return redirect('/'); });

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');
Route::post('/feedback', 'HomeController@feedback');

Route::view('/faq', "faq");
Route::view('/confidence', 'confidence');
Route::view('/rules', 'rules');

Route::view('404', '404');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','isAdmin']], function(){
    Route::get('/', 'Admin\PageController@index');
    Route::get('/users', "Admin\PageController@users");
    Route::get('/user/id={id}', "Admin\PageController@editUser");
    Route::get('/payments', 'Admin\PageController@payments');
    Route::get('/deposits', 'Admin\PageController@deposits');
    Route::get('/wallet-instruction', 'Admin\PageController@walletInstruction');
    Route::get('/user/id={id}/open-deposit/', 'Admin\PageController@openDeposit');
    Route::get('/user/id={id}/payment-create/', 'Admin\PageController@retrofittingPage');
    Route::get('/user/id={id}/payment-retroactively-creator/', 'Admin\PageController@retroActivelyPage');
    Route::get('/user/id{user_id}/deposit/id={id}/delete', 'Admin\ActionController@removeDeposit');
    Route::get('/user/id={id}/ref', "Admin\PageController@refsPage");
    Route::get('/user/id={user_id}/ref/id={id}/remove', "Admin\ActionController@removeRef");
    Route::get('/user/id={user_id}/ref/truncate', "Admin\ActionController@truncateRefs");
    Route::get('/payments/id={id}/delete', 'Admin\ActionController@removePayment');

    Route::group(['prefix' => 'post'], function(){
        Route::post('/user/id={id}/save', 'Admin\ActionController@editUserSaver');
        Route::post('/payment/update-status/id={id}', "Admin\ActionController@updatePaymentStatus");
        Route::post('/deposit/update-status/id={id}', "Admin\ActionController@updateDepositStatus");
        Route::post('/wallet-instruction/save', 'Admin\ActionController@walletInstructionSaver');
        Route::post('/add-bonus/{id}', 'Admin\ActionController@addBonus');
        Route::post('/deposit-creator/{id}', 'Admin\ActionController@createNewDeposit');
        Route::post('/payment-creator/{id}', 'Admin\ActionController@retrofitting');
    });
});

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){
    Route::get('/', function(){ return redirect()->action('Profile\PageController@cabinet'); });
    Route::get('/deposit/{deposit?}', 'Profile\PageController@deposit');
    Route::get('/balance/{type?}/{popup?}', 'Profile\PageController@payments');
    Route::get('/cabinet', 'Profile\PageController@cabinet');
    Route::get('/refs', 'Profile\PageController@refs');

    Route::group(['prefix' => 'post'], function(){
        Route::post('/personal-data-saver', 'Profile\ActionController@personalDataSaver');
        Route::post('/personal-wallets-saver', 'Profile\ActionController@personalWalletsSaver');
        Route::post('/payments-request', 'Profile\ActionController@paymentsRequest');
        Route::post('/deposit-request', 'Profile\ActionController@depositsRequest');
        Route::post('/replenishment-request', 'Profile\ActionController@replenishmentRequest');
    });
});

Route::group(['prefix' => 'advcash'],function(){
	Route::get('pay/{id}','AdvCashController@pay')->middleware('auth');
	Route::get('status','AdvCashController@status');
	Route::get('success','AdvCashController@success');
	Route::get('fail','AdvCashController@fail');
});