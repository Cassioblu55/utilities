<?php

namespace App\Http\Controllers;

use App\DefaultServerMessage;
use Illuminate\Http\Request;
use ProjectRoute;
use RoutingUtilities;

class DefaultServerMessagesController extends Controller
{
	const CONTROLLER_NAMESPACE = "defaultServerMessages";

    public function index(){
    	return view(self::CONTROLLER_NAMESPACE.".index");
    }

	public function edit(DefaultServerMessage $defaultServerMessage){
		$postLocation = ProjectRoute::makeRoute(self::CONTROLLER_NAMESPACE."/$defaultServerMessage->id/update");
		$headers = $this->getUpdateHeaders($postLocation);
		return view(self::CONTROLLER_NAMESPACE.".edit", compact('defaultServerMessage', 'headers'));
	}

	public function show(DefaultServerMessage $defaultServerMessage){
		return view(self::CONTROLLER_NAMESPACE.".show", compact('defaultServerMessage'));
	}

	public function create(){
		$defaultServerMessage = new DefaultServerMessage();
		$postLocation = ProjectRoute::makeRoute(self::CONTROLLER_NAMESPACE."/add");
		$headers = $this->getCreateHeaders($postLocation);
		return view(self::CONTROLLER_NAMESPACE.".edit", compact('defaultServerMessage', 'headers'));
	}

	public function add(Request $request){
		$request['fade_out'] = ($request->has('fade_out')) ? true : false;
		$request['fade_in'] = ($request->has('fade_in')) ? true : false;
		DefaultServerMessage::create($request->all());
		$message = RoutingUtilities::fixUrlParam("Record Added Successfully");
		return redirect()->action("DefaultServerMessagesController@index", ["successMessage" => $message]);
	}

	public function update(Request $request, DefaultServerMessage $defaultServerMessage){
		$request['fade_out'] = ($request->has('fade_out')) ? true : false;
		$request['fade_in'] = ($request->has('fade_in')) ? true : false;
		$defaultServerMessage -> update($request->all());
		$message = RoutingUtilities::fixUrlParam("Record Updated Successfully");
		return redirect()->action("DefaultServerMessagesController@index", ["successMessage" => $message]);
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
		$postLocation = ProjectRoute::makeRoute(self::CONTROLLER_NAMESPACE."/add");
		$headers = $this->getCreateHeaders($postLocation);
		return view(self::CONTROLLER_NAMESPACE.".edit", compact('defaultServerMessage', 'headers'));
	}

}


