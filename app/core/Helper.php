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
		if (!empty($params)) {
			foreach ($params as $param) {
				$info[$param] = Request::input($param);
			}
			return $info;
		}
		return false;
	}

	public static function toJSON($data)
	{
		return json_encode($data);
	}

	public static function responseCode($number = null)
	{
		return http_response_code($number);
	}
}