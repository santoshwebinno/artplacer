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
// Route::get('/{vue_capture?}', function () {
//     return view('index');
// })->where('vue_capture', '[\/\w\.-]*');
Route::get('/', function () {
    return view('welcome');
})->middleware(['auth.shopify'])->name('home');
Route::get('/getwidget', 'HomeController@index')->middleware(['auth.shopify']);
Route::get('/create', 'HomeController@create')->middleware(['auth.shopify']);
Route::post('/addwidget', 'HomeController@store')->middleware(['auth.shopify']);
Route::get('/show', 'HomeController@edit');
Route::get('/showewidge/{id}', 'HomeController@show')->middleware(['auth.shopify']);
Route::post('/editwidget', 'HomeController@update')->middleware(['auth.shopify']);
Route::get('/destroy/{id}', 'HomeController@destroy')->middleware(['auth.shopify']);
Route::get('/script', 'ShopifyController@index')->middleware('cors')->name('script');