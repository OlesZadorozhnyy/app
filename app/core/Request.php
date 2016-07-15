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

	public static function getPost()
	{
		if (isset($_POST)) {
			return $_POST;
		}
	}

	public static function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public static function isGet()
	{
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}

	public static function isAjax()
	{
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}

}
