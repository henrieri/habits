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

Route::get('/', function () {
    return view('landing.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'app'], function() {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/habits', 'HabitsController@index')->name('habits');

    Route::get('/today', 'TodayController@index')->name('today');

    Route::get('/progress', 'ProgressController@index')->name('progress');

    Route::get('/history', 'HistoryController@index')->name('history');

});