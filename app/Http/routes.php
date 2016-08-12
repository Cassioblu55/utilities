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

Route::get('showMessages/alt', 'ShowMessagesController@alt');

Route::get('showMessages/simple', 'ShowMessagesController@simple');

Route::get('errorDisplay', 'ErrorDisplayController@index');

Route::get('clickableTabs', 'ClickableTabsController@index');