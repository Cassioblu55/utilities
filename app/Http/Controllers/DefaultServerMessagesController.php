<?php

namespace App\Http\Controllers;

use App\DefaultServerMessage;
use Illuminate\Http\Request;

class DefaultServerMessagesController extends Controller
{
    public function index(){
    	return view('defaultServerMessages.index');
    }

	public function edit(DefaultServerMessage $defaultServerMessage){
		$headers = $this->getUpdateHeaders("update");
		return view('defaultServerMessages.edit', compact('defaultServerMessage', 'headers'));
	}

	public function show(DefaultServerMessage $defaultServerMessage){
		return view('defaultServerMessages.show', compact('defaultServerMessage'));
	}

	public function create(){
		$defaultServerMessage = new DefaultServerMessage();
		$headers = $this->getCreateHeaders('add');
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
		$headers = $this->getCreateHeaders("add");
		return view('defaultServerMessages.edit', compact('defaultServerMessage', 'headers'));
	}

}


