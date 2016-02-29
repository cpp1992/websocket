var module = angular.module("file",[]);
module.factory("$file",function($http){
	this.upload = function(path,obj){
		           var fd = new FormData();
                        fd.append("path", path);
                        fd.append("file",obj);
                   var xhr = new XMLHttpRequest();

           		   xhr.open("post", "/index.php?method=ajax&act=fileUpload", true);
           		   this.success = function(d)
           		   {
           		   	xhr.onload = function(data)
           		   	{
           		   		//console.log(data);
           		   		d(data.target.responseText,data.target.status);
           		   	}
           		   	return this;
           		   }
              	    xhr.upload.onprogress = function(evt)
           		   	{
           		   	}
           		   this.uploading = function(d)
           		   {
           		   	 xhr.upload.onprogress = function(evt)
           		   	{
           		   		d(evt);
           		   	}
           		   }
                  xhr.send(fd);
                  return this;
                    /*var args = {
                        method: 'POST',
                        url: "/index.php?method=ajax&act=fileUpload",
                        data: fd,
                        headers: {'Content-Type': undefined},
                        transformRequest: function(data){
                        	return data;
                        }
                    };
                    console.log($http);
                    return $http(args);*/

	}
	return this;
});