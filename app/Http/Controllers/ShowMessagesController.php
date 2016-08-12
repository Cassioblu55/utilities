<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ShowMessagesController extends Controller
{
    public function index(){
    	return view('showMessages.index');
    }

    public function alt(){
    	return view('showMessages.alt');
    }

    public function simple(){
    	return view('showMessages.simple');
    }
}
