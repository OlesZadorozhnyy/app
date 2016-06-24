<?php

class Controller
{
	private $view;
	public $uses = [];
	public $params = [];

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
				$this->{$item} = new $item;
			}	
		} else {
			$this->{$controller} = new $controller;
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
}
