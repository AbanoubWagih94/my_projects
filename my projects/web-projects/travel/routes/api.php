<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', "UserController@login");

Route::group(['middleware' => 'Authoroties'], function () {
    Route::resource('task', 'TaskController');
    Route::put('accomplish_task/{id}', 'TaskController@accomplish');
    Route::resource('report', 'ReportController');
    Route::put('accomplish_report/{id}', 'ReportController@accomplish');
    Route::post('travel/{travel_id}/pligrim', 'PligrimController@store');
    Route::post('travel/{travel_id}/pligrim/{id}', 'PligrimController@update');
    Route::resource('user', 'UserController', ['except'=>['create','edit']]);
    Route::get('logout', "UserController@logout");
    Route::put('reset', "UserController@resetPassword");
    Route::post('excel', 'ExcelController@upload');
    Route::resource('company', 'CompanyController', ['except'=>['create','edit']]);
    Route::resource('area', 'AreaController', ['except'=>['create','edit']]);
    Route::resource('sight_seeing', 'SightSeeingController', ['except'=>['create','edit']]);
    Route::resource('travel', 'TravelController', ['except'=>['store','create','edit']]);
    Route::resource('company.travel', 'CompanyTravelController', ['only'=>['index','show','store','destroy']]);
    Route::resource('area.travel', 'TravelAreaController', ['only'=>['index','show']]);
    Route::put('travel_area/{travel_area_id}', 'TravelAreaController@update');
    Route::resource('travel.area', 'AreaToTravelController', ['only'=>'store']);
    Route::post('travel/{travel_id}/terminal', 'TravelTerminalController@store');
    Route::resource('terminal', 'TerminalController', ['only'=>['update', 'show', 'index']]);
    Route::resource('notification', 'NotificationController', ['only'=>['update', 'index']]);
});
