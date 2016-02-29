var main_directive = angular.module("main_directive",[]);
	main_directive.directive("inputBox",function(){
	return{
		restrict : "E",
		replace : true,
		templateUrl : '/app/static/tpl/assembly/inputBox.html'
	};
   });
   main_directive.directive("chatItem",function(){
   	   return{
   	   	restrict : "E",
   	   	repalce:true,
   	   	templateUrl : '/app/static/tpl/assembly/chatItem.html',
   	   	link : function()
   	   	{
   	   		require_once("chatPage.css?ncvncn","css");
   	   	}
   	   }
   	});
    main_directive.directive("toolBar",function(){
   	   return{
   	   	restrict : "E",
   	   	repalce:true,
   	   	templateUrl : '/app/static/tpl/assembly/toolBar.html',
   	   	link : function()
   	   	{
   	   		
   	   	}
   	   }
   	});

main_directive.directive("yWidth",function(){
   		return{
   			restrict : "A",
   			replace  : "false",
   			require  : "ngModel",
   			link     : function(scope,element,attrs,c){
   				scope.$watch(attrs.ngModel,function(){
   				   element[0].style.width = c.$modelValue;
   				});
   			}
   		}
   	});
main_directive.directive("addWindow",function(){
	return{
		restrict : "E",
		replace  :true,
		templateUrl : "/app/static/tpl/assembly/addWindow.html"
	}
});