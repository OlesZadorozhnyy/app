<?php

class Controller
{
	private $view;
	public $uses = [];
	public $params = [];

	private $filterRules = ['auth', 'guest'];

	public function __construct($controller, $params)
	{
		$this->params = $params;
		$this->view = new View($controller);
		$this->setModels($controller);
	}

	public function setModels($controller)
	{
		if(!empty($this->uses)) {
			foreach ($this->uses as $item) {
				if (class_exists($item)) {
					$this->{$item} = new $item;
				}
			}	
		} else {
			if (class_exists($controller)) {
				$this->{$controller} = new $controller;
			}
		}
	}

	public function set($name, $value)
	{
		return $this->view->set($name, $value);
	}

	public function display($template)
	{
		return $this->view->render($template);
	}

	public function filters()
	{

	}

	public function beforeAction($action)
	{
		$rules = $this->filters();
		if (isset($rules['auth'])) {
			foreach ($rules['auth']['pages'] as $page) {
				if (!Session::exists(Config::get('session.sessionName')) && $page == $action) {
					Helper::redirect($rules['auth']['redirect']);
				}
				
			}
		}

		if (isset($rules['guest'])) {
			foreach ($rules['guest']['pages'] as $page) {
				if (Session::exists(Config::get('session.sessionName')) && $page == $action) {
					Helper::redirect($rules['guest']['redirect']);
				}
				
			}
		}
	}
}
