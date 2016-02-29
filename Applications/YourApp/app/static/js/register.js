var app = angular.module("reg",[]);
app.controller("do_reg",function($scope,$http){
	$scope.reg = function(){
		if(($scope.user.pwd!=$scope.user.re_pwd)||($scope.reg_form.$invalid))
		return;

		$http.post('index.php?method=ajax&&act=registe',{'userName':$scope.user.name,'password':$scope.user.pwd},{headers:{ 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}}).success(
			function(data, status, headers, config) {
				self.location.href = "/";
    });
	}
});