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

//WebSite
use App\Post;

Route::get('/', function () {
    $posts = Post::paginate(3);
    return view('home', compact('posts'));
});

Route::get('/post/{id}', 'AdminPostsController@post')->name('post.show');

// Auth
Route::get('/auth/login', 'AuthController@index')->name('loginForm');
Route::get('/auth/register', 'AuthController@register')->name('registerForm');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/register', 'AuthController@store')->name('register');
Route::get('/logout', 'AuthController@logout')->name('logout');


// Admin
Route::middleware('admin')->group(function (){
    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/media', 'AdminMediaController');
    Route::delete('delete/media', 'AdminMediaController@mediaDelete')->name('mediaDelete');
    Route::get('/admin', function (){
        return view('admin.index');
    });
});

//auth users

Route::resource('admin/comments', 'PostCommentsController');
Route::resource('admin/comment/replies', 'CommentRepliesController');
