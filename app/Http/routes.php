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
Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'WelcomeController@index');

	Route::get("showMessages", 'ShowMessagesController@index');

	Route::get('showMessages/alt', 'ShowMessagesController@alt');

	Route::get('showMessages/simple', 'ShowMessagesController@simple');

	Route::get('errorDisplay', 'ErrorDisplayController@index');

	Route::get('clickableTabs', 'ClickableTabsController@index');

	Route::get('defaultServerMessages', 'DefaultServerMessagesController@index');
	Route::get('defaultServerMessages/data', 'DefaultServerMessagesController@data');

	Route::get('defaultServerMessages/create', 'DefaultServerMessagesController@create');
	Route::put('defaultServerMessages/add', 'DefaultServerMessagesController@add');

	Route::get('defaultServerMessages/{defaultServerMessage}', 'DefaultServerMessagesController@show');
	Route::get('defaultServerMessages/{defaultServerMessage}/edit', 'DefaultServerMessagesController@edit');
	Route::get('defaultServerMessages/{defaultServerMessage}/data', 'DefaultServerMessagesController@findById');
	Route::get('defaultServerMessages/{defaultServerMessage}/clone', 'DefaultServerMessagesController@cloneObject');
	Route::patch('defaultServerMessages/{defaultServerMessage}/update', 'DefaultServerMessagesController@update');
	Route::delete('defaultServerMessages/{defaultServerMessage}/delete', 'DefaultServerMessagesController@delete');

	Route::get('defaultServerMessages/{defaultServerMessage}/css', 'DefaultServerMessagesController@css');
	Route::get('defaultServerMessages/css', 'DefaultServerMessagesController@listCss');

});




