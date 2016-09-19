<?php

Route::get('/', 'WelcomeController@index');

Route::get('utilTest', function(){
	return  view("utilsTest");
});

Route::get("showMessages", 'ShowMessagesController@index');

Route::get('showMessages/alt', 'ShowMessagesController@alt');

Route::get('showMessages/simple', 'ShowMessagesController@simple');

Route::get('errorDisplay', 'ErrorDisplayController@index');

Route::get('clickableTabs', 'ClickableTabsController@index');

Route::get('defaultServerMessages', 'DefaultServerMessagesController@index');
Route::get('defaultServerMessages/data', ['uses' => 'DefaultServerMessagesController@data', 'as' => 'serverMessagesData']);

Route::get('defaultServerMessages/create', 'DefaultServerMessagesController@create');
Route::put('defaultServerMessages/add', 'DefaultServerMessagesController@add');

Route::get('defaultServerMessages/{defaultServerMessage}', 'DefaultServerMessagesController@show');
Route::get('defaultServerMessages/{defaultServerMessage}/edit', 'DefaultServerMessagesController@edit');
Route::get('defaultServerMessages/{defaultServerMessage}/data', 'DefaultServerMessagesController@findById');
Route::get('defaultServerMessages/{defaultServerMessage}/clone', 'DefaultServerMessagesController@cloneObject');
Route::patch('defaultServerMessages/{defaultServerMessage}/update', 'DefaultServerMessagesController@update');
Route::delete('defaultServerMessages/{defaultServerMessage}/delete', 'DefaultServerMessagesController@delete');

Route::get('defaultServerMessages/data/findCSSByUrlParam', 'DefaultServerMessagesController@findCSSByUrlParam');


Route::auth();

Route::get('/home', 'WelcomeController@index');


Route::get('oneTimePad', function(){
	return view('oneTimePad');

});

Route::get('onetimepad', function(){
	return view('oneTimePad');

});
