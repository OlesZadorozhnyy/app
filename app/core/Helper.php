<?php

class Helper
{
	public static function hash($password)
	{
		return sha1($password);
	}

	public static function redirect($location)
	{
		header('Location: ' . $location);
		exit();
	}
}