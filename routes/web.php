<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
Route::get('/', function () {return view('welcome');});
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//make auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//pagescontroller
Route::get('/', 'pageController@index');
Route::get('/about', 'pageController@about');
Route::get('/contact', 'pageController@contact');
Route::get('/howto', 'pageController@howto');
Route::get('/display', 'pageController@display');
Route::get('/encode', 'pageController@encode');
Route::get('/encodedimage', 'pageController@encodedimage');

//imagecontroller
//Route::resource('/images', 'imageController');
Route::get('/display','imageController@show');
Route::post('/store','imageController@store');
Route::get('/store','imageController@store');


//codecontroller
Route::get('/encode-image', 'codeController@encodeImage');
Route::post('/encode-image', 'codeController@encodeImage');
Route::get('/decode', 'codeController@decode');
Route::post('/decode', 'codeController@decode');
Route::post('/counter', 'codeController@count');

//ajax route
Route::post('/ajaxstore','AjaxController@store');