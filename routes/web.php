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

// Initial view
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'RootAppController@index');
Route::get('login/minecraft.jp', 'Auth\ExternalAuthController@toProvider');
Route::get('login/minecraft.jp/callback', 'Auth\ExternalAuthController@fromProvider');
Route::get('logout/minecraft.jp', 'Auth\ExternalAuthController@logout');
Route::match(['get', 'post'], 'login', 'Auth\ExternalAuthController@toProvider')->name('login');
Route::get('users/{uuid}', 'UserPageController@onRequest')->where('uuid', '[A-Fa-f\d]{32,32}');
// There will be a 404.
