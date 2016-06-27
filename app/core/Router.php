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
		$url = trim($_SERVER['REQUEST_URI'], '/');
		$urlItems = explode('/', $url);

		if (!empty($urlItems[0])) {
			$this->controller = $urlItems[0];
		}

		if (!empty($urlItems[1])) {
			$this->action = $urlItems[1];
		}

		if (count($urlItems) > 2) { 
			$this->params = array_slice($urlItems, 2);
		}
	}

	public function run()
	{
		$controllerName = ucfirst($this->controller) . 'Controller';
		$actionName = 'action' . ucfirst($this->action);

		$view = strtolower($this->action);
		$errorView = strtolower(preg_replace('/action/', null, Config::get('router.defaultErrorAction')));

		if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
			$this->controller = new $controllerName($this->controller, $this->params);
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
