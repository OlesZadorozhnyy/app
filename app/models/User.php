<?php

class User extends Model
{

	protected $tableName = 'user';

	protected $isLogged = false;

	public $scenario;

	public $validationRules = [
		'register' => [
			'username' => [
				'required' => true,
				'unique' => true,
				'min' => 6,
				'max' => 16
			],
			'email' => [
				'required' => true,
				'email' => true,
				'unique' => true,	
			],
			'password' => [
				'required' => true,
				'matches' => 'confirmPassword',
				'min' => 6,
				'max' => 16
			]
		],
		'auth' => [
			'login' => [
				'required' => true
			],
			'password' => [
				'required' => true
			]
		]
	];

	public function auth($login, $password)
	{
		$user = function($name) use ($login, $password){
			return $this->find([$name => $login, 'password' => Helper::hash($password)]);
		};

		if ($user('username')) {
			return $user('username');
		} elseif ($user('email')) {
			return $user('email');
		}
	}

	public function isLogged()
	{
		if (Session::exists('user')) {
			return $this->isLogged = true;
		}
	}

}