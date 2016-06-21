<?php

class View
{
	private $workingFolder;
	private $temlatesRoot = 'templates';
	private $data = [];

	public function __construct($workingFolder)
	{
		$this->workingFolder = $workingFolder;
	}

	public function set($name, $value)
	{
		return $this->data[$name] = $value;
	}

	public function get($name)
	{
		return $this->data[$name];
	}

	public function render($template)
	{
		ob_start();
		extract($this->data);
		include $this->temlatesRoot . '/' . $this->workingFolder . '/' . $template . '.php';
		$result = ob_get_clean();
		echo $result;
	}
}