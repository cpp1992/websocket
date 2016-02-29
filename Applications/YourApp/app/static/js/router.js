require("service/angular-ui-router.js","js");

var router = angular.module("router",['ui.router','index']);
router.config(function($stateProvider, $urlRouterProvider){
	$urlRouterProvider.when("","mainPage");
	$stateProvider.state("chatPage",
		{
			url:"/chatPage",
			templateUrl:"/app/static/tpl/chatPage.html",
		})
	.state("mainPage",{
		url:"/mainPage",
		templateUrl:"/app/static/tpl/mainPage.html",
		controller:"plugin_init"
	});
});