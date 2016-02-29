var system = {};
var getFilePath = function(file) //获取文件相对路径
             {
                 var filePath = [];
                $script = $("script");
                for(var i=0;i< $script.length ; i++)
                {
                  var src = $($script[i]).attr('src');
                  src = src?src.replace(/\\/g,'/'):"undefined";
                  var fileName = src.substring(src.lastIndexOf('/')+1,src.length);
                 if(fileName == file)
                  {
                  	filePath[0] = src.substring(0,src.lastIndexOf('/')+1);
                  	filePath[1] = src.substring(0,src.lastIndexOf('/')-2);
                  }
                  
                }
            return filePath;
            };
var fileIsExist = function(file)
{
	$script = $("script");
	for(var i=0;i< $script.length ; i++)
                {
                  var src = $($script[i]).attr('src');
                  src = src?src:"none";
                  if(src.indexOf(file)>=0)
                  	return true;
                }
                return false;
}
var require = function(file,type)
{
          var fileQuote = function(fileName,tagName)  //在document尾部添加文件引用
            {

            	if(system.path==undefined||system.path=="")
            	{
            		var path = getFilePath("main.js");

            		system.path = path[0];
            		system.jsPath = path[0];
            		system.cssPath = path[1]+"css/";
            	}
                $doc = $("body");
                switch(tagName)
                {
                    case "js" :  $doc.append("<script src="+system.jsPath+fileName+"></script>"); break;
                    case "css"   :  $doc.append("<link rel='stylesheet' href="+system.cssPath+fileName+" />"); break;
                    case 'title' : $doc.append("<title>"+fileName+"</title>");break;
                    default       :  $doc.append("<"+tagName+"></"+tagName+">"); break;
                }
            }

            fileQuote(file,type);
}
var require_once = function(file,type)
{
	if(fileIsExist(file))
		return;
	require(file,type);

}

var slide_bottom = function()
{
	$("#chat-content").scrollTop($("#chat-content")[0].scrollHeight);
}