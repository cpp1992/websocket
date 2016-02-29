require("directive.js","js");
require("router.js","js");
require("service/websocket_service.js","js");
require("models/userModel.js",'js');
require("controller/mainController.js","js");
require("controller/indexController.js","js");
require("controller/chatController.js","js");
require("service/ping.js","js");
require("controller/fileController.js","js");
require("service/file_service.js","js");
require("service/chatService.js","js");
require("controller/addController.js","js");

$user = new user();

var app = angular.module("main",[
	'main_directive',
	"websocket_service",
	"main_controller",
	'router',
	'index',
	'chat',
	'ping',
	'fileController',
	'addController'
	]);
