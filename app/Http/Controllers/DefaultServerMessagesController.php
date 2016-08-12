<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DefaultServerMessagesController extends Controller
{
    public function index(){
    	return view('defaultServerMessages.index');
    }

	public function edit(){
		return view('defaultServerMessages.edit');
	}

	public function show(){
		return view('defaultServerMessages.show');
	}

	public function add($defaultMessage){

	}

	public function findById($id){

	}

	public function update($defaultMessage){

	}

	public function delete($defaultMessage){

	}

	public function data(){

	}
}
