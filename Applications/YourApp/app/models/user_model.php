<?php
/*
function:The model for user.
author  : Yoha Cai
*/
class User
{
	private $id;
	private $userName;
	private $clientId;
	private $password;
	private $status;  //online or offline
	private $DB;

	public function __construct($username,$password="",$DB="")
	{
		if(!@$GLOBALS['DB'])
			$this->DB = $DB;
		else
			$this->DB = $GLOBALS['DB'];
		$this->userName = $username;
		$this->password = $password;
		$this->getUserInfo();
	}
	public function getUserInfo()
	{
		$sql = "select * from user where username='$this->userName'";
		$res = $this->DB->dql($sql);
		if($res)
		{
			$this->id = $res[0]['id'];
			$this->status = $res[0]['status'];
		}
	}
	public function getClientId()
	{
		return $this->clientId;
	}
	public function getUserName()
	{
		return $this->userName;
	}
	public function getUserId()
	{
		return $this->id;
	}
	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}
	public function login()
	{
		//login into system
		$sql = "select * from user where username = '$this->userName'";
		$res = $GLOBALS['DB']->dql($sql);
		if($res[0]['password']==$this->password)
		{
		   $this->id = $res[0]['id'];
		   $this->status = $res[0]['status'];
           $_SESSION['is_login'] = 1;
           $_SESSION['user_id'] = $this->id;
           $_SESSION['user_name'] =  $this->userName;
           $_SESSION['check'] =  $this->password;
           echo 1;
		}
		else
			echo 0;
	}
    public function register()
	{
		$sql = "insert into user(username,password) values('$this->userName','$this->password')";
		$res = $GLOBALS['DB']->dml($sql);
		return $res;
		//registe into system
	}
	public function checkUser($id,$DB)
	{
		$sql = "select * from user where username = '$this->userName'";
		$res = $DB->dql($sql);
		if($res[0]['password']==$this->password)
           {
           	 if($res[0]['id']==$id)
           	 	return 1;
           	 else 
           	 	return 0;
           }
		else
			return 0;
	}
	public function log_out()
	{
		//login out the system;
	}
}
?>