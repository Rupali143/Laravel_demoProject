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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('product','ProductController');

Route::resource('category','CategoryController');

Route::post('updateOrder','CategoryController@updateOrder')->name('update.order');

Route::get('/logout',array('as' => 'logout','uses' =>'Auth\LoginController@logout'));

Route::get('/test',function (){
  return view('test');
});

Route::get('delete_order/{id}', 'ProductController@deleteorder')->name('delete.order');

//Route::get('delete','ProductController@delete');

Route::post('updateSort','CategoryController@updateSort')->name('update.sort');