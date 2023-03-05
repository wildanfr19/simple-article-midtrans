<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();




 Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth','CheckRole:admin,user']], function(){
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('artikel/dashboard','ArtikelController@dashboard')->name('artikel.dashboard');
    Route::resource('artikel','ArtikelController');
    Route::get('artikel/dashboard/show','ArtikelController@dashboardShowAdmin')->name('artikel.dashboardshow');
    Route::get('artikel/dashboard/{param}/detail','ArtikelController@dashboardShowDetailAdmin')->name('artikel.detail');
    Route::get('artikel/category/free','ArtikelController@free')->name('artikel.free');
    Route::get('artikel/category/berbayar','ArtikelController@berbayar')->name('artikel.berbayar');

    Route::get('order/{param}/ordercheck','OrderController@orderCheckout')->name('order.index');
    Route::post('order/bayar','OrderController@bayar')->name('order.bayar');
    Route::get('order/{param}/invoice','OrderController@invoice')->name('order.invoice');
    // Route::post('order/bayar/callback-midtrans','OrderController@callBack')->name('callback');

});





