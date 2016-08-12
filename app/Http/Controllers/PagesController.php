<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about(){
    	$name = ['first'=> 'Cassio',
	        'last' => 'Hudson'
	    ];

    	return view('about', $name);
    }
}
