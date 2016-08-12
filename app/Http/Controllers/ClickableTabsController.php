<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClickableTabsController extends Controller
{
    public function index(){
    	return view('clickableTabs.index');
    }
}
