<?php
require_once APP_ROOT."/app/models/user_model.php";
session_start();
$params = json_decode(file_get_contents("php://input",true));
$username = $params->userName;
$pwd = md5($params->password);
file_put_contents("x.txt", $username);
$user = new User($username,$pwd);
$res = $user->register();

if($res==1)
$login_res = $user->login();

echo $res;
?>