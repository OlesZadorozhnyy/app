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

	public static function showErrors($errors, $name)
	{
		if (array_key_exists($name, $errors)) {
			$result = '<div>';
			foreach ($errors[$name] as $error) {
				$result .= '<p style="color:red;">' . $error . '</p>';
			}
			$result .= '</div>';

			return $result;
		}
	}

	public static function setData($params = [])
	{
		foreach ($params as $param) {
			$result[$param] = Request::input($param);
		}
		return $result;
	}
}