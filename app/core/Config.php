<?php

class Config
{
	private static $data = [];

	public static function set($data = [])
	{
		return self::$data = $data;
	}

	public static function get($path = null)
	{
		if ($path) {
			$pathArray = explode('.', trim($path));
			var_dump($pathArray);
			foreach ($pathArray as $key => $item) {
				if (isset(self::$data[$item])) {
					$setting = self::$data[$item];
				}

				if (isset($setting[$item])) {
					return $setting[$item];
				}
			}
		} else {
			return false;
		}
	}
}