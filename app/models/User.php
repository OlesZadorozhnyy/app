<?php

class User extends Model
{
	protected $tableName = 'user';
	public $validationRules = [
		'username' => [
			'required' => true,
			'matches' => 'username2',
			'unique' => true
		]

	];

}