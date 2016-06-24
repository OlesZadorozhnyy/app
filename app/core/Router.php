<?php

class Router
{
	public $controller;
	public $action;
	public $params = [];


	public function __construct()
	{
		$this->controller = Config::get('router.defaultController');
		$this->action = Config::get('router.defaultAction');
		$url = rtrim($_SERVER['REQUEST_URI'], '/');
		$urlItems = explode('/', $url);

		if (isset($urlItems[1]) && !empty($urlItems[1])) {
			$this->controller = $urlItems[1];
		}

		if (isset($urlItems[2]) && !empty($urlItems[2])) {
			$this->action =  $urlItems[2];
		}

		if (count($urlItems) > 3) { 
			$this->params = array_slice($urlItems, 3);
		}
		var_dump($this);
	}

	public function run()
	{
		$controllerName = ucfirst($this->controller) . 'Controller';
		$actionName = 'action' . ucfirst($this->action);

		$view = strtolower($this->action);
		$errorView = strtolower(preg_replace('/action/', null, Config::get('router.defaultErrorAction')));

		if (class_exists($controllerName)) {
			$this->controller = new $controllerName($this->controller, $this->params);
		}

		if (method_exists($this->controller, $actionName)) {

			call_user_func_array([$this->controller, $actionName], $this->params);
			$this->controller->display($view);

		} else {

			$controllerName = ucfirst(Config::get('router.defaultController')) . 'Controller';

			$this->controller = new $controllerName(Config::get('router.defaultController'), $this->params);
			$this->controller->{'action' . Config::get('router.defaultErrorAction')}();
			$this->controller->display($errorView);
		}
	}
}
