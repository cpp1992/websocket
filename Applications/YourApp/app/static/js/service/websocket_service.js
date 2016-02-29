var module = angular.module("websocket_service",[]);
module.factory("websocket",function(){
	var ws = {};
	this.connect = function(address)
	{
	ws = new WebSocket('ws://'+address);
	return ws;
    }
    return this;
});