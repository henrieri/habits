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


Route::group(['prefix' => 'app'], function() {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    

});


Route::group(['prefix' => 'api'], function() {

    Route::resource('habits', 'HabitsController');

    Route::group(['prefix' => 'habits'], function() {

        Route::group(['prefix' => '{habit}'], function() {

            Route::resource('reasons', 'ReasonsController');

        });

    });

    Route::get('today', 'DaysController@today');

    Route::put('today/habits/{habit}', 'DaysController@updateStatus');

    Route::get('history', 'DaysController@index');
});