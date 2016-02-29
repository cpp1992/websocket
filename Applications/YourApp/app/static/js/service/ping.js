var module = angular.module("ping",[]);
module.factory("ping",function($interval){
	this.send = function(ws,id)
	{
		$interval(function(){
		var data = {'type':'ping','message':'','username':'','check':'','from':id,"to":""};
			ws.send(angular.toJson(data));
		},1000);
	}
	return this;
});