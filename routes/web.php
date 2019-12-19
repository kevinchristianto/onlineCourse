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
Route::get('/', 'HomeController@index')->name('home');
Route::redirect('/home', '/');

Route::resource('user', 'UserController')->except(['create']);
Route::resource('materi', 'MateriController')->except(['create']);
Route::post('materiUpload', 'MateriController@handleUpload')->name('materi.handleUpload');
Route::resource('fasilitas', 'KepesertaanController')->except(['create']);

Auth::routes(['register' => false, 'password.request' => false]);
