<?php
//error_reporting(0);
defined('ACC') || exit('access denied');
/*
网站的初始化文件
负责计算当前网站的根目录
负责 引入所有页面都需要的引入的公共文件.

*/

// ROOT 代表网站的根路径
define('ROOT',str_replace('\\','/',str_replace('includes\init.php','',__FILE__)));

include(ROOT . 'includes/conf.class.php');
include(ROOT . 'includes/mysql.class.php');
include(ROOT . 'includes/lib_base.php');
include(ROOT . 'model/Model.php');
include(ROOT . 'model/artModel.php');
include(ROOT . 'model/keywordsModel.php');
include(ROOT . 'model/linksModel.php');
include(ROOT . 'model/msgModel.php');
include(ROOT . 'model/orderModel.php');
include(ROOT . 'model/picModel.php');
include(ROOT . 'model/userModel.php');
include(ROOT . 'helper/cart.php');
include(ROOT . 'helper/image.php');
include(ROOT . 'helper/page.php');
//include(ROOT . 'helper/tools.php');
include(ROOT . 'helper/upfile.php');

/*
注意,此处应加上$_GET,$_POST,$_COOKIE的字符转义
具体: 判断魔术引号是否开启,
如果未开启,则把$_GET,$_POST,$_COOKIE
递归的转义一遍
*/

if(!get_magic_quotes_gpc()) {
    array_walk_recursive($_GET,'addslashes_real');
    array_walk_recursive($_POST,'addslashes_real');
    array_walk_recursive($_COOKIE,'addslashes_real');
}



//301
$the_host = $_SERVER['HTTP_HOST'];//取得当前域名
//echo $the_host;
$the_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面部分
//echo $the_url;
//echo getdomain($the_host);
$www_host = 'm.'.getdomain($the_host);
//echo $www_host;
$url = 'http://'.$www_host.$the_url;
//echo $url;

if($the_url=="/index.php"){
$the_url="";//如果是首页，赋值为空
}
if($the_host !== $www_host){
header('HTTP/1.1 301 Moved Permanently');//发出301头部
header('Location:'.$url);//跳转到带www的网址
}

function getdomain($url) {
$host = strtolower ( $url );
if (strpos ( $host, '/' ) !== false) {
$parse = @parse_url ( $host );
$host = $parse ['host'];
}
$topleveldomaindb = array ('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'pro', 'name', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me' );
$str = '';
foreach ( $topleveldomaindb as $v ) {
$str .= ($str ? '|' : '') . $v;
}

$matchstr = "[^\.]+\.(?:(" . $str . ")|\w{2}|((" . $str . ")\.\w{2}))$";
if (preg_match ( "/" . $matchstr . "/ies", $host, $matchs )) {
$domain = $matchs ['0'];
} else {
$domain = $host;
}
return $domain;
}

$arr_host = array(
	'd.com'=>array(
		'hid'=>1,
		'filename_template'=>'/view-{$temp_id}.html',
		'sitename'=>'dddddd',
		'title'=>'eeeeeeeeeeeee',
		'keys'=>'aaaaaaaaaaa',
		'description'=>'bbbbbbbbbb',
	),
	'e.com'=>array(
		'hid'=>1,
		'filename_template'=>'/view-{$temp_id}.html',
		'sitename'=>'dddddddd',
		'title'=>'eeeeeeeeeeeee',
		'keys'=>'aaaaaaaaaaa',
		'description'=>'bbbbbbbbbb',
	),
	
		
	
);
//site
$main_url = getdomain($the_host);
//echo $main_url;
if(!in_array($main_url,array_keys($arr_host))){
	die('url error !');
}

extract($arr_host[$main_url]); // $keyu_seo_title  $hid $muban
//print_r($arr_host[$main_url]);
//print_r(extract($arr_host[$main_url]));
//print_r($arr_host);


//site index
$siteIndex = $arr_host[getdomain($the_host)];
$siteIndex['domain'] = 'http://www.'.getdomain($the_host);
$siteIndex['mdomain'] = 'http://m.'.getdomain($the_host);
//print_r($siteIndex);


// 创建目录
$cache_dir = ROOT . 'data/cache/'.$main_url;
mk_dir($cache_dir);

//creat dir
function mk_dir($path) {
	//$path = ROOT . '/data/images/' . $main_url;
	if(is_dir($path)){
		return $path;
	}
	return mkdir($path,'0777',true)?$path:false;
}
	




//print_r($smarty);exit;




function base_encode($str){
    $src = array("/", "+", "=");
    $dist = array("_a", "_b", "_c");
    $old = base64_encode($str);
    $new = str_replace($src, $dist, $old);
 
    return $new;
}
 
function base_decode($str) {
    $src = array("_a", "_b", "_c");
    $dist = array("/", "+", "=");
    $old = str_replace($src, $dist, $str);
    $new = base64_decode($old);
 
    return $new;
}

function cn_substr_utf8($str, $length, $start=0)
    {
        if(strlen($str) < $start+1)
        {
            return '';
        }
        preg_match_all("/./su", $str, $ar);
        $str = '';
        $tstr = '';

        //为了兼容mysql4.1以下版本,与数据库varchar一致,这里使用按字节截取
        for($i=0; isset($ar[0][$i]); $i++)
        {
            if(strlen($tstr) < $start)
            {
                $tstr .= $ar[0][$i];
            }
            else
            {
                if(strlen($str) < $length + strlen($ar[0][$i]) )
                {
                    $str .= $ar[0][$i];
                }
                else
                {
                    break;
                }
            }
        }
        return $str;
    }
require(ROOT."/includes/smarty.inc.php");//引入配置文件 

//Powered By QQ786290473
$COPYRIGHT = '<!--Powered By QQ786290473-->';
$LINKVIEWNUM = 15;
$LINKINDEXOTHERNUM = 2;

session_start(); // 初始化时即开启sesstion


