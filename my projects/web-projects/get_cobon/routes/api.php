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

Route::put('offer/{id}/rate/{rate}', 'UserActions@rate');
Route::post('admin/login', 'AdminController@login');
Route::post('admin/store', 'AdminController@store');
Route::group(['middleware' => 'Authoroties'], function () {
    Route::delete('admin/logout', 'AdminController@logout');
    Route::resource('country', 'CountriesController');
    Route::get('country/restore/{id}', 'CountriesController@restore');
    Route::resource('city', 'CitiesController');
    Route::get('city/restore/{id}', 'CitiesController@restore');
    Route::resource('category', 'CategoriesController');
    Route::get('category/restore/{id}', 'CategoriesController@restore');
    Route::resource('vendor', 'VendorsController');
    Route::get('vendor/restore/{id}', 'VendorsController@restore');
    Route::resource('branch', 'BranchesController');
    Route::get('branch/restore/{id}', 'BranchesController@restore');
    Route::resource('offer', 'OffersController'); 
    Route::resource('term', 'SiteTermsController'); 
    Route::get('vendor/{vendorId}/branches', 'VendorBranchesController@index');
    Route::get('vendor/{vendorId}/offers', 'VendorOffersController@index');
    Route::get('offer/{offerId}/branches', 'OffersBranchesController@index');
    Route::put('offer/{offerId}/branches', 'OffersBranchesController@update');
    Route::put('branch/{branchId}/images', 'BranchImagesController@update');
    Route::put('offer/{offerId}/images', 'OfferImagesController@update');
    Route::get('/images', 'ImageHandler@imageList');
    Route::post('/upload', 'ImageHandler@upload');    
});