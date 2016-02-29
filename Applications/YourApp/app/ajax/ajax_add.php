<?php
   $params = json_decode(file_get_contents("php://input",true));
   $target = $params->target;
   $fid    = $params->fid;
   $uid = @$_SESSION['user_id'];
   if($target=="friend")
   {
   	 if($fid!=""&&$uid!="")
   	 {
   	 	$sql = "insert into notice(userid,content,type) values('$fid','$uid','1')";
   	 	$res = $GLOBALS['DB']->dml($sql);
   	 	echo $res;
   	 }
   	 else
   	 	echo 0;
   }
   else
   	echo 0;
?>