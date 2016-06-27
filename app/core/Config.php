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
			if (strpos($path, ".") !== false) {
				$pathArray = explode('.', trim($path));
				
				foreach ($pathArray as $key => $item) {
					if (isset(self::$data[$item])) {
						$setting = self::$data[$item];
					}

					if (isset($setting[$item])) {
						return $setting[$item];
					}
				}
			} else {
				return self::$data[$path];
			}
			
		} else {
			return false;
		}
	}
}
