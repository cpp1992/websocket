<?php
if(!is_logined())
	redirect("login");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html ng-app="main" ng-cloak>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>websocket通信系统</title>
<link href="/app/static/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://kylestetz.github.io/CLNDR/css/full-clndr.less" rel="stylesheet" type="text/css"/>
<script src='/app/static/js/common/angular.min.js'></script>
<script src="/app/static/js/common/jquery.js"></script>
</head>

<body ng-controller="main_controller">

<div class="content">
    <add-window ng-show="addOpera"></add-window>
	<nav role="navigation" class="left-panel" id="sidebar">
		<!--用户信息 -->
		<div class="ng-profile">
			<img src="/app/static/images/person.png" alt="" class="img-circle" id="userPic">			
			<div class="info">
				<span id="userName" ng-init="updateUserInfo()">&nbsp;{{userName}}({{userId}})<state id='state' ng-hide="connected">连接中...</state></span>
				<ul class="list-inline">
					<li><img src="/app/static/images/pen.png" class="modify" id="showInfo"></li>
					<li><img src="/app/static/images/jia.png" ng-click='addOpera=!addOpera' class="add" id="addPerson"></li>
				</ul>				
			</div>			
		</div>	
		
		<!-- 选项 -->
		<div class="ng-tab" id="switchPanel">
			<div class="tab-item ">
				<a href="javascript:;" class="panel-tab" data-type="conversations"><span class="icon icon-chat cur"></span></a>
			</div>

			<div class="tab-item ">
				<a href="javascript:;" class="panel-tab" data-type="contacts"><span class="icon icon-list"></span></a>
			</div>
			
			<div class="tab-item tab-group">
				<a href="javascript:;" class="panel-tab" data-type="teams"><span class="icon icon-team"></span></a>
			</div>			
		</div>

        <!-- 最近联系人 -->
		<div class="ng-list" id="chatList">
			<p class="icon-loading ng-hide" ng-hide="chatList.length > 0">
			    <img src="/app/static/images/icon_loading.gif" alt="">正在获取最近的聊天...</p>
			<div class="scroll-element">
				<div class="scroll-element_corner"></div>
				<div class="scroll-arrow scroll-arrow_less"></div>
				<div class="scroll-arrow scroll-arrow_more"></div>
				<div class="scroll-element_outer"></div>
			</div>

			<div ng-repeat="chatContact in chatList" class="ng-scope">
        		<div class="chat-item slide-left ng-scope active">
		            <div class="person-avatar" >
		                <img class="person-img" text="_web" src="/app/static/images/person.png" alt="" >
		            </div>
		            <div class="person-item">
		                <h3 class="person-nickname">
		                    <span class="person-nickname-text ng-binding" ng-bind-html="chatContact.getDisplayName()">卢胖</span>
		                </h3>
		            </div>
                </div>
            </div>
		</div>


		<!-- 通讯录 -->
		<div class="ng-list hidden" id="personList">
		</div>
		<!-- 群组 -->
		<div class="ng-list hidden" id="groupList">
		</div>

		<!-- 搜索框 -->
	    <div class="search-bar" id="search-bar">
	        <i class="web-search"></i>
	        <input type="text" class="form-search" placeholder="搜索"/ >
	    </div>
	</nav>



	<div class="right-panel" >
		<!--工具栏-->
	<tool-bar></tool-bar>
		<div class="boxing">
			<a href="javascript:" class="setting" title="设置">
				<img src="/app/static/images/setting.png"></a>
			<a href="javascript:" class="exit" title="退出" id="logout">退&nbsp;出</a>
		</div>
		
		<div data-ui-view=""> <!--路由-->

		</div>
	
	</div>


</div>
<script src="/app/static/js/common/common.js"></script>
<script type="text/javascript" src="/app/static/js/main.js"></script>
<?php
$code = "\$user.id = '".$_SESSION['user_id']."';
         \$user.name = '".$_SESSION['user_name']."';
         \$user.check = '".$_SESSION['check']."';
        ";
script($code);
?>
</body>

</html>
