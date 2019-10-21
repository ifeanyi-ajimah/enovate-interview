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

// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/', function () {
    return view('enovate');
});



Route::get('{path}',"EmployeeController@index1")->where('path', '([a-zA-Z\-\/_.]+)?' );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
