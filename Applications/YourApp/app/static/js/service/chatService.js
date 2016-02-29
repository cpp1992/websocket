var module = angular.module("chatService",[]);
module.factory("chat",function(){
	this.sendTextMessage;
	this.sendFileMessage;
	return this;
});