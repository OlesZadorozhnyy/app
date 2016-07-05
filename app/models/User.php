<?php

class User extends Model
{

	protected $tableName = 'user';

	protected $isLogged = false;

	protected $authFieldsSearch = ['username', 'email'];

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

		foreach ($this->authFieldsSearch as $field) {
			$data = $user($field);
			if (!empty($data)) {
				Session::set(Config::get('session.userId'), $data[0]['id']);
				$this->isLogged = true;
				return true;
			}
		}
		return false;
	}

	public function isLogged()
	{
		if (Session::exists(Config::get('session.userId'))) {
			return $this->isLogged = true;
		}
	}

}