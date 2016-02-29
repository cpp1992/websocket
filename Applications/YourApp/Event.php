<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
require_once '/app/models/user_model.php';
require_once 'public/db.php';
require_once '/app/models/message_model.php';
require_once '/system/socket_router.php';
session_start();
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Event
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    private static $DB;
    public static function onConnect($client_id)
    {
      self::$DB = new DB();
        // 向当前client_id发送数据 
        //$data['clientId'] = $client_id;
       // Gateway::sendToClient($client_id, json_encode($data));
         
        // 向所有人发送
       // Gateway::sendToAll("$client_id login");
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {

          $data = json_decode($message);
          $type = $data->type;
          $to  = $data->to;
          $from = $data->from;
          $content = $data->message;
          //var_dump($data);
        if($_SESSION['user_id']=="")
        {
        $user = new User($data->username,$data->check,self::$DB);
        $check = $user->checkUser($from,self::$DB);
        if($check==1)
              $_SESSION['user_id'] = $from;
            else
              return;
        }
        Gateway::bindUid($client_id,$_SESSION['user_id']);
        $message = new Message($to,$from,$content,self::$DB);
        $message->handle($type);
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
       // 向所有人发送 
       GateWay::sendToAll("$client_id logout");
   }
}
