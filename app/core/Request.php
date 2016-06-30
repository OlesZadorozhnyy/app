<?php

class Request
{

	public static function exists($name)
	{
		return isset($_POST[$name]);
	}

	public static function input($name)
	{
		if (self::exists($name)) {
			return $_POST[$name];
		} else {
			return false;
		}	
	}

	public static function all()
	{
		if (isset($_POST)) {
			return $_POST;
		}
	}

	public static function post()
	{
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public static function ajax()
	{
		return !empty(($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
}
