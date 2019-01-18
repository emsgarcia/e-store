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

// ITEMS
Route::get('/catalog', 'ItemController@showItems');
Route::get('/menu/add', 'ItemController@showItemAddForm');
Route::get('/menu/{id}', 'ItemController@itemDetails');
Route::post('/menu/add', 'ItemController@saveItems');
Route::patch('/menu/{taskid}', 'ItemController@updateItem');
Route::delete('/itemdelete/{id}' , 'ItemController@deleteItem');

// CART
Route::post('/addToCart/{id}', 'ItemController@addToCart');
Route::get('/showcart', 'ItemController@showCart');
Route::delete('/cartItemdelete/{id}' , 'ItemController@deleteCartItem');

