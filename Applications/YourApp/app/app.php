<?php
class App
{
	public function run()
	{
		$path = $GLOBALS['router']->getRouter();
		require_once APP_ROOT.$path;
	}
}
?>