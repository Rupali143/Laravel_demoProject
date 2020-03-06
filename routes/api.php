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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('displayProductsCart','Front\ShoppingCartController@displayProductsCart');


Route::post('/register','Api\ApiController@register');

Route::post('/login','Api\ApiController@login');

Route::get('/displayProducts','Api\ApiController@displayProducts');

Route::get('/productDetails/{id}','Api\ApiController@productDetails');


Route::post('/myWishList/{productId}/{userId}','Api\ApiController@myWishList');

Route::post('/myProfile','Api\ApiController@myProfile');


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('logout', 'Api\ApiController@logout');
});

