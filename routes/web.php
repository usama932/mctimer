<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
Route::get('/user', function () {
    return view('auth.user');
});
Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Auth::routes();

Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'client',
    'namespace'     => 'Client'
], function ()
{
    Route::get('/dashboard', 'ClientController@index')->name('client.dashboard');
	Route::get('/profile', 'ClientController@edit')->name('client-profile');
	Route::post('/admin-update', 'ClientController@update')->name('client-update');


});

Route::group([
    'middleware'    => ['auth','is_admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');
    //Setting Routes
    Route::resource('setting','SettingController');
    //Category
    Route::resource('categories','CategoryController');
    Route::post('get-categories', 'CategoryController@getCategories')->name('admin.getCategroies');
	Route::post('get-category', 'CategoryController@categoryDetail')->name('admin.getCategory');
	Route::get('category/delete/{id}', 'CategoryController@destroy');
	Route::post('delete-selected-category', 'CategoryController@deleteSelectedCategory')->name('admin.delete-selected-category');


    //Product
    Route::resource('products','ProductController'); 
    Route::post('get-products', 'ProductController@getProducts')->name('admin.getProducts');
	Route::post('get-product', 'ProductController@productDetail')->name('admin.getProduct');
	Route::get('product/delete/{id}', 'ProductController@destroy');
	Route::post('delete-selected-products', 'ProductController@deleteSelectedProducts')->name('admin.delete-selected-products');


	//User Routes
	Route::resource('clients','ClientController');
	Route::post('get-clients', 'ClientController@getClients')->name('admin.getClients');
	Route::post('get-client', 'ClientController@clientDetail')->name('admin.getClient');
	Route::get('client/delete/{id}', 'ClientController@destroy');
	Route::post('delete-selected-clients', 'ClientController@deleteSelectedCategory')->name('admin.delete-selected-clients');



});

