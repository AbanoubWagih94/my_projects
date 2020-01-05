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
    return view('website.index');
});

Route::get('/about', function () {
    return view('website.pages.about');
});

Route::get('/portfolio', function () {
    return view('website.pages.portfolio');
});

Route::get('/contact', function () {
    return view('website.pages.contact');
});

Route::post('/portfolio-details', function () {
    $data = json_encode($_POST['JSdata'], JSON_PRETTY_PRINT);
    return view('website.pages.portfolio', compact('data'));
});