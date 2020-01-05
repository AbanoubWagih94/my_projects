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

use Illuminate\Http\Request;
use App\Offer;
use App\Vendor;
use App\City;
use App\Category;

Route::get('/', function() {
    $countries = City::all();
    $categories = Category::all();
    session(['cities'=>$countries, 'categories'=>$categories]);
    $newOffers = Offer::with('images')->orderBy('created_at', 'dec')->limit(4)->get();
    $hotOffers = Offer::with('images')->orderBy('buying_count', 'dec')->limit(9)->get();
    return view('site.home')
    ->with('newOffers', $newOffers)
    ->with('hotOffers', $hotOffers);
})->name('home');

Route::get('/offers', function(Request $request) {
    $offers = Offer::with('images')
    ->join('branch_offers', 'offers.id', 'branch_offers.offer_id')
    ->join('branches', 'branches.id', 'branch_offers.branch_id')
    ->join('vendors', 'vendors.id', 'offers.vendor_id')
    ->select('offers.*')
    ->orderBy('offers.created_at', 'dec');
    if($request->input('city')){
        $offers->where('branches.city_id', $request->input('city'));
    }
    if($request->input('category')){
        $offers->where('vendors.category_id', $request->input('category'));
    }
    $offers = $offers->paginate(12);
    // return$offers;
    return view('site.offers')
    ->with('offers', $offers);
})->name('offers');

Route::get('/vendors', function(Request $request) {
    $vendors = Vendor::with(['branches', 'category']);
    if($request->input('category')){
        $vendors->where('category_id', $request->input('category'));
    }
    $vendors = $vendors->paginate(20);
    return view('site.vendors')
    ->with('vendors', $vendors);
})->name('vendors');

Route::get('/offer/{id}', function($id) {
    $offer = Offer::where('id', $id)->with('images')->get()[0];
    return view('site/offer')
    ->with('offer', $offer);
})->name('offer');

Route::get('/vendor/{id}', function($id) {
    $vendor = Vendor::where('id', $id)->with(['branches', 'category', 'branches.city'])->get()[0];
    return view('site.vendor')
    ->with('vendor', $vendor);
})->name('vendor');

Route::get('/login', function() {
    return view('site.login');
})->name('login');

Route::get('cart', function() {
    return view('site.cart');
})->name('cart');

Route::post('login', 'UserActions@login');
Route::get('logout', 'UserActions@logout')->name('logout');
Route::post('register', 'UserActions@store')->name('register');