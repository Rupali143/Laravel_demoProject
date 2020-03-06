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

//Admin Start

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

Route::get('changeStatus', 'ProductController@changeStatus');

Route::get('changeStatusCat', 'CategoryController@changeStatusCat');

Route::get('/frontEnd', 'UserController@index');

Route::resource('subcategory','SubCategoryController');

Route::get('fetch_subCategory/{id}','ProductController@fetchsubCategory')->name('fetch_subCategory');

Route::get('orders','ProductController@orderList')->name('users.order');

Route::get('orderDetails/{id}','ProductController@orderDetails')->name('users.orderDetails');



Route::middleware(['admin'])->group(function () {

    
});

//Admin End


//front-End Start

Route::get('/fetchProducts/{id}', 'Front\ProductController@index')->name('fetch.products');

Route::get('userLoginForm','Front\UserController@index')->name('frontEnd.login');

Route::post('userLogin','Front\UserController@login')->middleware('admin');

Route::post('userRegister','Front\UserController@register');

//Login with google start
Route::get('google', function () {return view('googleAuth');});
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle')->name('auth.google');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
////Login with google end

//My profile & change password start
Route::get('profileDisplay','Front\UserController@profileDisplay')->name('profileDisplay');
Route::post('updateProfile','Front\UserController@updateProfile')->name('updateProfile');
Route::get('/changePassword','Front\UserController@showChangePasswordForm')->name('changePassword');
Route::post('/changePassword','Front\UserController@changePassword')->name('change.Password');
//My profile & change password end


//My WishList Start
Route::get('/favourite/{productId}','Front\ProductController@addfavourite')->name('favourite')->middleware('admin');
Route::get('/myWishList','Front\ProductController@displayWishList')->name('myWishList');
Route::get('deleteWishList/{id}','Front\ProductController@deleteWishList')->name('deleteWishList');
//My WishList End


Route::get('productDetails/{id}','Front\ProductController@productDetails')->name('product.details');

//Shopping Cart
Route::get('productAddToCart/{id}','Front\ShoppingCartController@index')->name('cart.add')->middleware('admin');
Route::get('displayProductsCart','Front\ShoppingCartController@displayProductsCart')->name('cart.display')->middleware('admin');

Route::get('removeProductFromCart/{id}','Front\ShoppingCartController@removeProductFromCart')->name('deleteSession.product');

Route::post('increaseQuantity','Front\ShoppingCartController@increaseQuantity')->name('increase.quantity');

Route::post('decreaseQuantity','Front\ShoppingCartController@decreaseQuantity')->name('decrease.quantity');

Route::get('checkout','Front\ShoppingCartController@getCheckout')->name('fetch.checkout');

Route::post('checkoutPost','Front\ShoppingCartController@checkoutPost')->name('post.checkout');

Route::get('placeOrder','Front\ShoppingCartController@placeOrder')->name('place.order');

Route::get('myOrderProduct','Front\ShoppingCartController@myOrderProduct')->name('my.order');

Route::get('myOrderDetails/{id}','Front\ShoppingCartController@myOrderDetails')->name('my.orderDetails');

Route::post('test','Front\ShoppingCartController@test')->name('post.test');




