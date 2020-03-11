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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/chat', 'ChatController@show')->name('chat.show.own');
Route::get('/chat/{chat}', 'ChatController@show')->name('chat.show');

Route::post('/chatmessage/store', 'ChatMessageController@store')->name('chatmessage.store');

