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

/* Admin Routes*/
Route::prefix('admin')->group(function (){
    Route::middleware('auth:admin')->group(function(){
        // Dashboard
        Route::get('/' ,'DashboardController@index')->name('dashboard');

        // Products
        Route::resource('/products', 'ProductController');

        // Orders
        Route::resource('/orders', 'OrderController');
        Route::get('/order/{id}/change/{status}', 'OrderController@changeStatus')->name('order.changeStatus');

        //Users
        Route::resource('/users','UserController');
        Route::get('/user/{id}/change/{status}', 'UserController@changeStatus')->name('user.changeStatus');

        //Logout
        Route::get('/logout', 'AdminUserController@logout')->name('admin.logout');
    });

    //Admin login
    Route::get('/login', 'AdminUserController@index');
    Route::post('/post', 'AdminUserController@store')->name('admin.store');
});

/* Front Routes*/
Route::middleware('auth')->group(function (){
    //Profile route
    Route::get('/user/profile', 'FrontControllers\ProfileController@index');
    Route::get('/user/order/{id}', 'FrontControllers\ProfileController@show')->name('user.orders');
    Route::get('/user/edit/{id}', 'FrontControllers\ProfileController@edit');
    Route::put('/user/edit/{id}/', 'FrontControllers\ProfileController@update')->name('user.update');

    //cart
    Route::resource('/cart', 'FrontControllers\CartController');
    Route::post('/cart/saveLater/{id}', 'FrontControllers\CartController@saveLater')->name('cart.saveLater');



    //save for later
    Route::post('/cart/moveToCart/{id}', 'FrontControllers\SaveLaterController@moveToCart')->name('moveToCart');
    Route::delete('/saveLater/destroy/{id}', 'FrontControllers\SaveLaterController@destroy')->name('saveLater.destroy');

    //Checkout
    Route::get('/checkout', 'FrontControllers\CheckoutController@index');
    Route::post('/checkout', 'FrontControllers\CheckoutController@store')->name('checkout.store');
});

Route::get('/','FrontControllers\HomeController@index');

//Registration route
Route::get('/user/register','FrontControllers\RegistrationController@index');
Route::post('/user/register', 'FrontControllers\RegistrationController@store')->name('user.register');

// Login profile
Route::get('/user/login', 'FrontControllers\SessionsController@index');
Route::post('/user/login', 'FrontControllers\SessionsController@store')->name('user.login');

//Logout
Route::get('/user/logout', 'FrontControllers\SessionsController@logout');


Route::get('/empty',function (){
    Cart::instance('default')->destroy();
});

