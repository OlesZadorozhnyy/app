<?php

class View
{
	private $workingFolder;
	private $temlatesRoot = 'templates';
	private $data = [];
	private $endFile = '.php'; 

	public function __construct($workingFolder)
	{
		$this->workingFolder = strtolower($workingFolder);
	}

	public function set($name, $value)
	{
		return $this->data[$name] = $value;
	}

	public function get($name)
	{
		if (isset($this->data[$name])) {
			return $this->data[$name];	
		} else {
			return false;
		}
	}

	public function render($template)
	{
		ob_start();
		extract($this->data);
		include $this->temlatesRoot . '/' . $this->workingFolder . '/' . $template . $this->endFile;
		$result = ob_get_clean();
		echo $result;
	}
}