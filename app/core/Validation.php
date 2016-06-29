<?php

class Validation
{

	public static $errors = [];

	public static function min($name, $data, $rule)
	{
		if (strlen($data) < $rule) {
			return self::$errors[$name][] = 'Field must have more than ' . $rule . ' characters';
		}
	}

	public static function max($name, $data, $rule)
	{
		if (strlen($input) > $rule) {
			return self::$errors[$name][] = 'Field must have less than ' . $rule . ' characters';
		}
	}

	public static function unique($name, $data, $rule)
	{

		$modelName = debug_backtrace()[2]['class'];
		$model = new $modelName;

		$result = $model->find([$name => $data]);
		if (!empty($result)) {
			return self::$errors[$name][] = 'Write another ' . ucfirst($name);
		}	
	}

	public static function matches($name, $data, $rule)
	{
		if ($data !== $_POST[$rule]) {
			return self::$errors[$name][] = ucfirst($name) . ' doesn\'t match with ' . ucfirst($rule) . ' field';
		}
	}

	public static function email($name, $data, $rule)
	{
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
			return self::$errors[$name][] = 'Field doesn\'t contain email';
		}
	}

	public static function required($name, $data, $rule)
	{
		if (empty($data)) {
			return self::$errors[$name][] = 'Field is required';
		}
	}

	public static function getErrors()
	{
		return self::$errors;
	}
}
