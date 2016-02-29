var indexService = angular.module("indexService",[]);
indexService.factory("init_calendar",function()
	{
		require_once("common/moment.js","js");
        require_once("common/clndr.js","js");
        require_once("common/uncore.js","js");
        require_once("calendar.css","css");
		$("#plugin").clndr();
		return 1;
	});