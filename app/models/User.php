<?php

class User extends Model
{

	protected $tableName = 'user';

	public $validationRules = [
		'username' => [
			'required' => true,
			'unique' => true,
			'min' => 5,
			'max' => 6,
			'email' => true,
			'matches' => 'username2'
		]

	];

}