<?php 

class Session
{

	public static function set($name, $value)
	{
		if (strpos($name, ".") !== false) {
			$nameArr = explode('.', $name);
			if (count($nameArr) == 2) {
				return $_SESSION[$nameArr[0]][$nameArr[1]] = $value;
			} else {
				return false;
			}
		}
		return $_SESSION[$name] = $value;
	}

	public static function get($name)
	{
		if (strpos($name, ".") !== false) {
			$nameArr = explode('.', $name);
			if (self::exists($nameArr[0])) {
				if (count($nameArr) == 2) {
					return $_SESSION[$nameArr[0]][$nameArr[1]];
				} else {
					return false;
				}
			}
		} else {
			return $_SESSION[$name];
		}
	}	

	public static function exists($name)
	{
		return isset($_SESSION[$name]);
	}

	public static function delete($name)
	{
		if (self::exists($name)) {
			unset($_SESSION[$name]);
		} else {
			return false;
		}
	}

	public static function flash($name, $message = '')
	{
		if (self::exists($name)) {
			$session = self::get($name);
			self::delete($name);
			return $session;
		} else {
			$session = self::set($name, $message);
		}
	}
}