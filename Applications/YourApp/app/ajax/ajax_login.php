<?php
require_once APP_ROOT."/app/models/user_model.php";
session_start();
$params = json_decode(file_get_contents("php://input",true));
$username = $params->username;
$pwd = md5($params->password);
$user = new User($username,$pwd);

$login_res = $user->login();

echo $login_res;
?>