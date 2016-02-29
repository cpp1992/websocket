require("service/indexService.js","js");

var index = angular.module("index",['indexService']);

index.controller("plugin_init",function($scope){
	    require_once("common/moment.js","js");
        require_once("common/clndr.js","js");
        require_once("common/uncore.js","js");
        require_once("calendar.css","css");
		$("#plugin").clndr();
});
