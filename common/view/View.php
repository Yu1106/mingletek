<?php

namespace common\view;

use Exception;

class View
{
	private $data = array();

	private $dir = FALSE;

	public function __construct($template)
	{
		try {
			$file = RESOURCE_VIEWS_DIR . '/' . strtolower($template) . '.php';
			if (file_exists($file)) {
				$this->dir = $file;
			} else {
				throw new Exception('Template ' . $template . ' not found!');
			}
		} catch (Exception $e) {
			echo $e;
		}
	}

	public function assign($variable, $value)
	{
		$this->data[$variable] = $value;
	}

	public function render()
	{
		extract($this->data);
		ob_start();
		include($this->dir);
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}

?>