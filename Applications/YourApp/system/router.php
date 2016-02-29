<?php
class Router
{
	private $router;
	public function __construct()
	{
		$this->run();
	}
	private function run()
	{
		$method = @$_REQUEST['method'];
		$act = @$_REQUEST['act'];
		$this->router = '/app/views/main.php';
		if($method=="ajax")
		{
			switch ($act) {
				case 'login':$this->router = '/app/ajax/ajax_login.php';break;
				case 'registe':$this->router = '/app/ajax/ajax_register.php';break;
				case 'fileUpload':$this->router = '/app/ajax/ajax_file_upload.php';break;
				case 'add'    :$this->router = '/app/ajax/ajax_add.php';break;
				default:$this->router = '/';break;
			}
			return;
		}
		switch ($act) {
			case 'login':$this->router = '/app/views/login.html';break;
			case 'signup':$this->router = '/app/views/register.html';break;
		}
	}
	public function getRouter()
	{
		return $this->router;
	}
}
?>