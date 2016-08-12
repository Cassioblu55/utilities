<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get("showMessages", 'ShowMessagesController@index');

Route::get('defaultServerMessages/alt', 'ShowMessagesController@alt');

Route::get('defaultServerMessages/simple', 'ShowMessagesController@simple');

Route::get('errorDisplay', 'ErrorDisplayController@index');

Route::get('clickableTabs', 'ClickableTabsController@index');

//Admin show messages
Route::get('defaultServerMessages', 'DefaultServerMessagesController@add@index');
Route::get('defaultServerMessages/edit', 'DefaultServerMessagesController@edit');
Route::get('defaultServerMessages/show', 'DefaultServerMessagesController@show');