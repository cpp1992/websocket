<?php
use \GatewayWorker\Lib\Gateway;
class Message
{
	private $to;
	private $from;
	public $message;
	private $type;
	private $time;
	private $DB;
	public function __construct($to,$from,$message,$DB)
	{
		$this->to = $to;
		$this->from = $from;
		$this->message = $message;
		$this->DB = $DB;
	}
	private function save()
	{
		$sql = "insert into singleChat(recipientId,senderId,content,type) values('$this->to','$this->from','$this->message','$this->type')";
		$res = $this->DB->dml($sql);
		//file_put_contents("x.txt", $sql);
	}
	private function select()
	{

	}
	private function delete()
	{

	}
	private function chatHandle()
	{
		if($this->to==""||$this->from==""||$this->message=="")
			return;
		$data['message'] = $this->message;
		$data['type']    = $this->type;
		Gateway::sendToUid($this->to,json_encode($data));
		$this->save();
	}
	private function loginHandle()
	{
		//$this->pingHandle();
	}
	private function pingHandle()
	{
		$id = $this->from;
		$sql = "update user set ping=NOW() where id='${id}'";
		$this->DB->dml($sql);
	}
	public function handle($type)
	{
		$this->pingHandle();
		$this->type = $type;
		switch($type)
		{
			case 'chat':
			case 'image':
			case 'file':$this->chatHandle();break;
			case 'login':$this->loginHandle();break;
			default :;break;
		}
	}
}
?>