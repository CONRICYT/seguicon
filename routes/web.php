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
Route::get('/logout', function () {
    Auth::logout();
    return redirect('');
});

Route::group(['prefix' => '', 'middleware' => ['auth', 'AdminMiddle']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'AdminMiddle']], function () {
    Route::get('convenios', 'AgreementsController@admin_convenios');
    Route::get('contratos', 'AgreementsController@admin_contratos');
});

Route::group(['prefix' => 'agreements', 'middleware' => ['auth', 'AdminMiddle']], function () {
    Route::get('convenios', 'AgreementsController@convenios');
    Route::get('contratos', 'AgreementsController@contratos');
    Route::post('check', 'AgreementsController@check');
    Route::post('updateDate', 'AgreementsController@updateDate');
});

Route::group(['prefix' => 'views', 'middleware' => ['auth', 'AdminMiddle']], function () {
    Route::get('convenios', 'AgreementsController@view_convenios');
    Route::get('contratos', 'AgreementsController@view_contratos');
});

Auth::routes();
