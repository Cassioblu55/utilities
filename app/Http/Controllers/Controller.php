<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	protected function getCreateHeaders($postLocation){
		return (object) ["createOrUpdate" => "Create", "postLocation" => $postLocation, "methodField" => "PUT", "addOrSave" => "Add"];
	}

	protected function getUpdateHeaders($postLocation){
		return (object) ["createOrUpdate" => "Update", "postLocation" => $postLocation, "methodField" => "PATCH", "addOrSave" => "Save"];
	}

}
