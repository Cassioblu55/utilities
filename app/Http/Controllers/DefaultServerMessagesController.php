<?php

namespace App\Http\Controllers;

use App\DefaultServerMessage;
use Illuminate\Http\Request;
use ProjectRoute;

class DefaultServerMessagesController extends Controller
{
    public function index(){
    	return view('defaultServerMessages.index');
    }

	public function edit(DefaultServerMessage $defaultServerMessage){
		$postLocation = ProjectRoute::makeRoute("defaultServerMessage/$defaultServerMessage->id/update");
		$headers = $this->getUpdateHeaders($postLocation);
		return view('defaultServerMessages.edit', compact('defaultServerMessage', 'headers'));
	}

	public function show(DefaultServerMessage $defaultServerMessage){
		return view('defaultServerMessages.show', compact('defaultServerMessage'));
	}

	public function create(){
		$defaultServerMessage = new DefaultServerMessage();
		$postLocation = ProjectRoute::makeRoute("defaultServerMessage/add");
		$headers = $this->getCreateHeaders($postLocation);
		return view('defaultServerMessages.edit', compact('defaultServerMessage', 'headers'));
	}

	public function add(Request $request){
		$request['fade_out'] = ($request->has('fade_out')) ? true : false;
		$request['fade_in'] = ($request->has('fade_in')) ? true : false;
		DefaultServerMessage::create($request->all());
		return back();
	}

	public function update(Request $request, DefaultServerMessage $defaultServerMessage){
		$request['fade_out'] = ($request->has('fade_out')) ? true : false;
		$request['fade_in'] = ($request->has('fade_in')) ? true : false;
		$defaultServerMessage -> update($request->all());
		return back();
	}

	public function delete(DefaultServerMessage $defaultServerMessage){
		$defaultServerMessage->delete();
	}

	public function data(){
		return DefaultServerMessage::all();
	}

	public function findById(DefaultServerMessage $defaultServerMessage){
		return $defaultServerMessage;
	}

	public function cloneObject(DefaultServerMessage $defaultServerMessage){
		$postLocation = ProjectRoute::makeRoute("defaultServerMessage/add");
		$headers = $this->getCreateHeaders($postLocation);
		return view('defaultServerMessages.edit', compact('defaultServerMessage', 'headers'));
	}

}


