<?php

define('HOME', $_SERVER['DOCUMENT_ROOT'] . '/');

$settings = [
	'database' => [
		'driver' => 'MySQLDriver',
		'host' => 'localhost',
		'user' => 'root',
		'password' => '',
		'dbname' => 'map_db'
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
