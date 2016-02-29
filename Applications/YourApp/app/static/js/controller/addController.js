var module = angular.module("addController",[]);
module.controller("addController",function($scope,$http,$timeout){
	$scope.addFriend = function()
	{
		if($scope.requesting==1)
			return;
		if($scope.lastAdd==$scope.addFriendId)
			return;
		$scope.requesting = 1;
		$scope.lastAdd = $scope.addFriendId;
		var rUrl = "index.php?method=ajax&act=add";
		var rData = {"target":"friend","fid":$scope.addFriendId};
		$http({
			method : "POST",
			url    :  rUrl,
			data     : rData
			}).success(function(data,status){
			$scope.requesting = 0;
			if(data==1)
				$scope.addResult = "请求发送成功";				
			else
				$scope.addResult = "系统繁忙，请稍后再试！";
			$timeout(function(){
					$scope.addResult = "";
					$scope.$apply();
				},2000);
		}).error(function(){
			$scope.requesting = 0;
		});
	}
	$scope.addGroup = function()
	{

	}
});