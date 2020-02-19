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

//Route::get('/', function () {return view('welcome'); });

Route::get('/', 'Front\ProductController@index');

Auth::routes();

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('product','ProductController');

Route::resource('category','CategoryController');

Route::post('updateOrder','CategoryController@updateOrder')->name('update.order');

Route::get('/logout',array('as' => 'logout','uses' =>'Auth\LoginController@logout'));

Route::get('delete_order/{id}', 'ProductController@deleteorder')->name('delete.order');

Route::post('updateSort','CategoryController@updateSort')->name('update.sort');

//Route::get('changeStatus','ProductController@changeStatus')->name('change.status');

Route::get('changeStatus', 'ProductController@changeStatus');

Route::get('changeStatusCat', 'CategoryController@changeStatusCat');

Route::get('/frontEnd', 'UserController@index');

Route::resource('subcategory','SubCategoryController');

Route::get('fetch_subCategory/{id}','ProductController@fetchsubCategory')->name('fetch_subCategory');


Route::middleware(['admin'])->group(function () {

    
});



//front-End


Route::get('/fetchproducts/{id}', 'Front\ProductController@index')->name('fetch.products');

Route::get('userloginform','Front\UserController@index')->name('frontEnd.login');

Route::post('userLogin','Front\UserController@login')->middleware('admin');

Route::post('userRegister','Front\UserController@register');

Route::get('google', function () {return view('googleAuth');});

Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');

Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('profileDisplay','Front\UserController@profileDisplay')->name('profileDisplay');

Route::post('updateProfile','Front\UserController@updateProfile')->name('updateProfile');

Route::get('/changePassword','Front\UserController@showChangePasswordForm')->name('changePassword');

Route::post('/changePassword','Front\UserController@changePassword')->name('change.Password');

Route::get('/favourite/{productId}','Front\ProductController@addfavourite')->name('favourite')->middleware('admin');

Route::get('/myWishlist','Front\ProductController@displayWishlist')->name('myWishlist');

Route::get('deleteWishlist/{id}','Front\ProductController@deleteWishlist')->name('deleteWishlist');
