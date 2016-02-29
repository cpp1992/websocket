var chat = angular.module("chat",['chatService']);
chat.controller("sendMessage",function($scope,$timeout,$sce){

	$scope.sendTextMessage = function()
	{
		var message = {};
		$scope.messages = ($scope.messages?$scope.messages:[]);
		message.user = $user.name;
		message.time = "2-21 14:30";
		message.content = $scope.chatContent;
		message.other = false;
		$scope.messages.push(message);
		var data = {'type':'chat','message':$scope.chatContent,'username':$user.name,'check':$user.check,'from':$user.id,"to":"10005"};
		$scope.connect.send(angular.toJson(data));
		$scope.chatContent = "";
		$timeout(function(){slide_bottom();});
	}
	chat.sendTextMessage = $scope.sendTextMessage;
	$scope.sendFileMessage = function(type,path)
	{
		var data = {'type':type,'message':path,'username':$user.name,'check':$user.check,'from':$user.id,"to":"10005"};
		$scope.connect.send(angular.toJson(data));
	}
	chat.sendFileMessage = $scope.sendFileMessage;
	$scope.connect.onmessage = function(evt)
	{
		var data = angular.fromJson(evt.data);
		var message = {};
		$scope.messages = ($scope.messages?$scope.messages:[]);
		message.user = "yoha";
		message.time = "2-21 15:03";
		switch(data.type)
		{
			case 'chat' : 	message.content = data.message;break;
			case 'file' :   message.content = $sce.trustAsHtml("<label style='color:#336699'>您接收到一个新文件！</label><a target='_blank' href="+data['message']+">下载</a>");break;
			case 'image':   message.content = $sce.trustAsHtml("<img onload='slide_bottom()' src='"+data['message']+"' style='width:200px'/>");break;		
		}
		message.other = true;
		$scope.messages.push(message);
		$scope.$apply();
		slide_bottom();
	}
});