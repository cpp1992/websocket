<?php
if ($_FILES["file"]["error"] > 0)
    {
    	//echo ini_get('upload_max_filesize');
        echo $_FILES["file"]["error"];
    }
    else
    {
    	$file = $_FILES['file'];
		$postFix = explode(".",$file['name']);
		if(sizeof($postFix)==1)
			$postFix = "";
		else
		$postFix = ".".$postFix[sizeof($postFix)-1]; //文件后缀名
		$file_name = md5(uniqid(rand())).$postFix;
		$tmp_path = $file['tmp_name'];
		$file_path = "/app/static/upload/".$file_name;
		$ab_file_path = APP_ROOT.$file_path;
		move_uploaded_file($tmp_path, $ab_file_path);
		echo $file_path;
    }