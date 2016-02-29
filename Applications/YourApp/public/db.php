<?php
class sqlhelper
{   public  $db;
	private $dbhost='localhost';
	private $dbadmin='root';
	private $dbpass='950124';
	private $dbname='websocket';
	public function db_link()
	{
		$this->db=new mysqli($this->dbhost,$this->dbadmin,$this->dbpass,$this->dbname);
		$this->db->query("set names 'utf8'");
	}


	public function sql_dql($sql)  
	{ 
		$res=$this->db->query($sql);
		if(!empty($res))
		{
			$a="";
			$i = 0;
			while($b = $res->fetch_assoc())
			{
			    $a[$i] = $b;
				$i++;
			}
			
			$res->free();   
			return $a;      
		}
		else
			{
		    return 1;
		    }

	}

	public function sql_dml($sql)   
	{
		$b=$this->db->query($sql);
		if(!$b){
			return 0;}
		if($this->db->affected_rows>0){
			return 1;}
		else{
			return 2;}
	}
	public function close(){
	$this->db->close();

	}

}
class DB
{
	 private $db;
	 public function __construct()
	 {
	      $this->db = new sqlhelper();
	      $this->db->db_link();
	 }
     public function dql($sql)
    {

	 $sql = $sql;
	 $res = $this->db->sql_dql($sql);
	 if($res==""||$res==1)
		 return 0;
	 else
	 return $res;
   }
    public function dml($sql)
   {
	if(!is_array($sql))
	{
	 $sql = $sql;
	 $res = $this->db->sql_dml($sql);
	 $this->db->db->commit();
	 return $res;
	}
	else
	{
			 $res = 1;
	       $this->db = new sqlhelper();
	 $this->db->db_link();
	 $this->db->db->autocommit(false);
	 for($i=0;$i<count($sql);$i++)
		{
		 $res = $this->db->sql_dml($sql[$i]);
		 if($res==0)
			{
			     echo $res;
		         $this->db->db->rollback();
				 $res = 0;
				 break;
		    }
		}
		$this->db->db->autocommit(true);
      	 $this->db->db->commit();
		 //echo $res;
		 return $res;
	}
}
}
?>