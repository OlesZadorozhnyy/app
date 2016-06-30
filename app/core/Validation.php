<?php

class Validation
{

	public static $errors = [];

	public static $validationPassed = true;

	private static $requiresInstances = ['unique'];

	public static function min($name, $data, $rule)
	{
		if (strlen($data) < $rule) {
			self::$validationPassed = false;
			return self::$errors[$name][] = 'Field must have more than ' . $rule . ' characters';
		}
	}

	public static function max($name, $data, $rule)
	{
		if (strlen($data) > $rule) {
			self::$validationPassed = false;
			return self::$errors[$name][] = 'Field must have less than ' . $rule . ' characters';
		}
	}

	public static function unique($name, $data, $rule, $model)
	{
		$result = $model->find([$name => $data]);
		if (!empty($result)) {
			self::$validationPassed = false;
			return self::$errors[$name][] = 'Write another ' . ucfirst($name);
		}	
	}

	public static function matches($name, $data, $rule)
	{
		if ($data !== Request::input($rule)) {
			self::$validationPassed = false;
			return self::$errors[$name][] = ucfirst($name) . ' doesn\'t match with ' . ucfirst($rule) . ' field';
		}
	}

	public static function email($name, $data, $rule)
	{
		if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
			self::$validationPassed = false;
			return self::$errors[$name][] = 'Field doesn\'t contain email';
		}
	}

	public static function required($name, $data, $rule)
	{
		if (empty($data)) {
			self::$validationPassed = false;
			return self::$errors[$name][] = 'Field is required';
		}
	}

	public static function getErrors()
	{
		return self::$errors;
	}

	public static function getRequiresInstances()
	{
		return self::$requiresInstances;
	}

	public static function getResult()
	{
		return self::$validationPassed;
	}
}
