var app = angular.module("login",[]);
app.controller("login_act",function($scope,$http){
	$scope.do_login = function()
	{
		if($scope.login_form.$invalid)
			return;
		$http.post('index.php?method=ajax&act=login',{username:$scope.user.name,password:$scope.user.pwd}).success(function(data,status,headers,config){
			self.location.href = "/";
		});
	}
});