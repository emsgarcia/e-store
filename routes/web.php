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

// MIDDLE WEAR
Route::middleware("auth")->group(function(){
	//Routes that you don't want non logged in users to access
	Route::get('/menu/add', 'ItemController@showItemAddForm');
	Route::post('/menu/add', 'ItemController@saveItems');
	Route::patch('/menu/{taskid}', 'ItemController@updateItem');
	Route::delete('/itemdelete/{id}' , 'ItemController@deleteItem');

});


// ITEMS
Route::get('/catalog', 'ItemController@showItems');
Route::get('/menu/{id}', 'ItemController@itemDetails');


// CART
Route::post('/addToCart/{id}', 'ItemController@addToCart');
Route::get('/showcart', 'ItemController@showCart');
Route::delete('/menu/mycart/{taskid}/delete' , 'ItemController@deleteCartItem');
Route::post('/menu/clearcart' , 'ItemController@clearCart');
Route::patch('/menu/mycart/{taskid}/changequantity', 'ItemController@updateItemQuantity');

// AUTHENTICATION
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

