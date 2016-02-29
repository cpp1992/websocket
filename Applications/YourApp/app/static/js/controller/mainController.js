var main_controller = angular.module("main_controller",[]);
main_controller.controller("main_controller",["$scope","websocket",'ping',function($scope,websocket,ping){
	$scope.connect = websocket.connect("localhost:8282");
	$scope.connect.onopen = function(evt)
	{
		$scope.connected = true;
		$scope.$apply();
		$user.status = "online";
		var data = {'type':'login','username':$user.name,'check':$user.check,'from':$user.id,"to":"",message:""};
		$scope.connect.send(angular.toJson(data));
	}

	$scope.updateUserInfo = function()
	{
		$scope.userName = $user.name;
		$scope.userId   = $user.id;
		$scope.status   = $user.status;
	}

	ping.send($scope.connect,$user.id);

	$scope.messages = ($scope.messages?$scope.messages:[]);
}]);