<?php


Class ProjectRoute{

	public static function getProjectBase(){
		return env('project_base');
	}

	public static function makeRoute($url){
		$projectBase = env('project_base');
		return "$projectBase/$url";
	}

}
