<?php
	// 初始化时引入smarty
require(ROOT.'includes/smarty/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = ROOT . 'view';//设置模板目录
$smarty->compile_dir = ROOT . 'data/tmp';//设置编译目录
$smarty->compile_check = true;
//$smarty->cache_dir = ROOT . 'data/cache/'.$main_url;
//$smarty->debugging = true; //调试 
$smarty->cache_dir = $cache_dir;//缓存文件夹
$smarty->caching = true;
$smarty->cache_lifetime=60*60*24*1000;//one day 60*60*24
//$smarty->cache_lifetime = 10; //缓存存活时间（秒）

$smarty->use_sub_dirs = true;

$smarty->left_delimiter = '{';
$smarty->right_delimiter = '}';

function myfunc($arr){
	$str=$arr['con'];
	return base_encode($str);
	
}

function test($arr){
 $str = "";
 for($i=0;$i<$arr['times'];$i++){
  $str .= "<font size='".$arr['size']."' color='".$arr['color']."'>".$arr['con']."</font>";
 }
 return $str;
}


$smarty->registerPlugin("function","test","test");//第二个参数是模板文件调用的函数名称，可变；第三个参数是上面自定义的函数名称；相应于一个对应关系

$smarty->registerPlugin("function","myfunc","myfunc");

?>