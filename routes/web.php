<?php

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
    return view('welcome');
});
Route::get('/admin', function () {
    return view('admin.homeAdmin');
    
});
Route::get('admin/app/getTag', 'App\Http\Controllers\AdminController@getTag');


Route::post('admin/app/create_tag', 'App\Http\Controllers\AdminController@addtag');
Route::post('admin/app/edit_tag', 'App\Http\Controllers\AdminController@editTag');


Route::get('/admin/{any}', function () {
    return view('admin.homeAdmin');
    
})->where('any', '.*');