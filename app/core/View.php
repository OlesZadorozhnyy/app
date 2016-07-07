<?php

class View
{
	private $workingFolder;
	private $templatesRoot = 'templates';
	private $data = [];
	private $layoutFolder = 'layouts';
	private $layoutFile = 'master';
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
		$file = $this->templatesRoot . '/' . $this->workingFolder . '/' . $template . $this->endFile;
		extract($this->data);
		include $file;
		$content = ob_get_clean();

		ob_start();
		extract($this->data);
		include $this->templatesRoot . '/' . $this->layoutFolder . '/' . $this->layoutFile . $this->endFile;
		$result = ob_get_clean();
		echo $result;
	}
}