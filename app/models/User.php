<?php

class User extends Model
{

	protected $tableName = 'user';

	public $validationRules = [
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
			'matches' => 'confirm_password',
			'min' => 6,
			'max' => 16
		]
	];

	public function auth($login, $password)
	{
		$user =  $this->find([
			'(' => true,
			'username' => $login,
			'OR' => true,
			'email' => $login,
			')' => true,
			'AND' => true,
			'password' => $password
		]);

		if ($user) {
			return $user;
		}
	}

	public function authRules()
	{
		return [
			'login' => [
				'required' => true
			],
			'password' => [
				'required' => true
			]
		];
	}

}