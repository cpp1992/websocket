<?php
	function redirect($path)
	{
		$path = 'index.php?act='.$path;
		header("Location: $path");
	}

    function is_logined()
    {
    	$login = @$_SESSION['is_login'];
    	if($login!=1)
    		return 0;
    	else
    		return 1;
    }

    function script($code)
    {
           echo "<script>\n";
           echo $code;
           echo "\n</script>\n";
    }
?>