var file = angular.module("fileController",["file","chatService"]);

file.controller("fileController",["$scope","$file","$sce",'$timeout',function($scope,$file,$sce,$timeout){
	$scope.uploadFile = function(ele,type)
	{
		var filePath = angular.element(ele).val();
		var fileObj = ele.files[0];
		angular.element(ele).val("");
		if(filePath=="")
			return;

					    $scope.messages = ($scope.messages?$scope.messages:[]);
		                var msg = {};
						msg.user = $scope.userName;
						msg.time = "2-27 18:02";
						msg.isFile = true;
						msg.other = false;
						msg.progress = "0%";

		if(type=="img")
			{
				    var imgType = ["jpg","png","bmp","gif"];
					postFix = filePath.split(".");
					postFix = postFix[postFix.length-1];
					if($.inArray(postFix,imgType)<0)
					  {
						alert("请选择图片格式的文件!");
						return;
					  } 
					var render = new FileReader();
					render.onload = function(evt)
					{
						msg.content = "<img onload='slide_bottom()' src='"+evt.target.result+"' style='width:200px'/>";
				   		msg.content = $sce.trustAsHtml(msg.content);
						
					//alert(filePath);
					index = $scope.messages.push(msg);
		           }
		        render.readAsDataURL(fileObj);
		    }
		    else
		    {
		    	msg.content = filePath+"上传中...";
		    	msg.content = $sce.trustAsHtml(msg.content);
		    	index = $scope.messages.push(msg);
		    	$timeout(function(){
		                $("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
	                });
		    }
				$file.upload(filePath,fileObj).success(function(data,status){
					//console.log(chat);
					if(type=="img")
					  chat.sendFileMessage("image",data);
				    else
				    {
				    	chat.sendFileMessage("file",data);
				    	$scope.messages[index-1].content = $sce.trustAsHtml("<label style='color:#336699'>"+filePath+"</label>发送成功！<a target='_blank' href="+data+">下载</a>");
				    }
				    $scope.messages[index-1].isFile = false;
				}).uploading(function(evt){
					$scope.messages[index-1].progress = (evt.loaded/evt.total*100).toFixed(0)+"%";
					$scope.$apply();
	                });
	}
}]);