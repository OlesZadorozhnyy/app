<?php

define('HOME', $_SERVER['DOCUMENT_ROOT'] . '/');

session_start();

$settings = [
	'database' => [
		'driver' => 'MySQLDriver',
		'host' => 'localhost',
		'user' => 'root',
		'password' => '1Q2A3z4o',
		'dbname' => 'map_db'
	],
	'router' => [
		'defaultController' => 'Post',
		'defaultAction' => 'index',
		'defaultErrorAction' => 'error'
	],
	'session' => [
		'userId' => 'id'
	]
];

function autoloadClasses($class)
{
	$path = ['app/core/', 'app/interfaces/', 'app/controllers/', 'app/models/'];
	foreach ($path as $key => $item) {
		if (file_exists(HOME . $item . $class . '.php')) {
			include HOME . $item . $class . '.php';
		}
	}	
}

spl_autoload_register('autoloadClasses');

Config::set($settings);
