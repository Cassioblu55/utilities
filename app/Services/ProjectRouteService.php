<?php


Class ProjectRoute{

	public static function makeRoute($url){
		$projectBase = env('project_base');
		return "$projectBase/$url";
	}

}
