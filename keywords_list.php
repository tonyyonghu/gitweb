<?php
header("Content-type: text/html; charset=utf-8"); 

define('ACC',true);
require('./includes/init.php');

$page = isset($_GET['page'])?$_GET['page']+0:0;
$array=explode(".",$_SERVER['SERVER_NAME']);
//$cache_id = substr(md5('list_' . $page),0,12);
$cache_id = $array[1].'list' . $page;
$name = isset($_GET['name'])?$_GET['name']."":"";
if($name=="")
{
	$name="性感美女的真人图片";
}
else
{
	$name=base_decode($_GET['name']);
	
}


//随机取10个关键字
function keywordsRand($keysNum){
	$keywordsModel = new keywordsModel();
	$keywordInfos = $keywordsModel->keywordsInfos($keysNum);
	//echo 'keywords10';
	return $keywordInfos;
}
$smarty->clearCache("m_keywords_list.html");
if(!$smarty->isCached('m_keywords_list.html',$cache_id)) {

	$keywordsModel = new keywordsModel();
	$keywordsRandInfo = keywordsRand(15);
	$keywordsRandInfo2 = keywordsRand(20);
	$keywordsRandInfo3=keywordsRand(20);
	$keywordsRandInfo4=keywordsRand(20);
	$keywordsRandInfo5=keywordsRand(30);
	
	$keywordsRandInfo6=keywordsRand(30);
	$keywordsRandIndex = keywordsRand(20);
	
	$keywordsRandIndex1 = keywordsRand(15);
	$keywordsRandIndex2 = keywordsRand(15);

	// 计算栏目下的商品总量
	$total = $keywordsModel->keywordsNum();
	$perpage = 15;

	// 产生分页效果
	$page = new page($total,$perpage);
	$pagecode = $page->show();
	// 算偏移量 ,(页码-1)* perpage
	$offset = ($page->curr() - 1) * $perpage;

	$keywordsList = $keywordsModel->keywordsAll($offset,$perpage);
	$keywordsLists =keywordsRand(20);

	if($keywordsList == null){
		$keywordsList = keywordsRand($perpage);
	}
	
	
	//首页连接
	$i = 0;
	foreach($arr_host as $k=>$v){
		$linkIndex[$i]['host'] = 'http://www.'.$k;
		$linkIndex[$i]['sitename'] = $v['sitename'];
		$i++;
	}
	

	$keywords = array();
	foreach($keywordsList as $v){
		$keywords[] = $v['keyword'];
	}
	
	//keywordsListLinks
	$keywordsRandIndexLinks1 = array();
	$i=0;
	foreach($keywordsRandIndex1 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandIndexLinks1[$i]['link'] = $filename;
	$keywordsRandIndexLinks1[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	
	
	//right keywordsListLinks
	$keywordsListLinks = array();
	$i=0;
	foreach($keywordsList as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsListLinks[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsListLinks[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	
	//right keywordsListLinks
	$keywordsListLinkss = array();
	$i=0;
	foreach($keywordsLists as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsListLinkss[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsListLinkss[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	
	
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks = array();
	$i=0;
	foreach($keywordsRandInfo as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks1 = array();
	$i=0;
	foreach($keywordsRandInfo1 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks1[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks2 = array();
	$i=0;
	foreach($keywordsRandInfo2 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLink2[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLink2[$i]['name'] = $v['keyword'];
	$i++;
	}
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks3 = array();
	$i=0;
	foreach($keywordsRandInfo3 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks3[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks3[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks4 = array();
	$i=0;
	foreach($keywordsRandInfo4 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks4[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks4[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks5 = array();
	$i=0;
	foreach($keywordsRandInfo5 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks5[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks5[$i]['name'] = $v['keyword'];
	$i++;
	}
	//right keywordsRandInfoLinks
	$keywordsRandInfoLinks66 = array();
	$i=0;
	foreach($keywordsRandInfo6 as $v){
	$temp_id = $v['id'];
	//echo $temp_id ;
	eval("\$filename = \"$filename_template\";");
	//echo $filename .'<br />';
	$keywordsRandInfoLinks6[$i]['link'] = $filename;
	//$links[$i]['link'] = 'view-'.$v['id'];
	$keywordsRandInfoLinks6[$i]['name'] = $v['keyword'];
	$i++;
	}
	$smarty->assign('suiji_keywords',$bb);
	$smarty->assign("lanmu",$name);
	$smarty->assign('title',$title);
	$smarty->assign('siteIndex',$siteIndex);
	//$smarty->assign('keywordInfo',$keywordInfo);
	$smarty->assign('lanmu_name',$name);
	$smarty->assign('keywordsRandInfoLinks',$keywordsRandInfoLinks);
	$smarty->assign('keywordsRandIndex1',$keywordsRandIndex1);
	$smarty->assign('keywordsRandIndex2',$keywordsRandIndex2);
	$smarty->assign('keywordsRandInfoLinks1',$keywordsRandInfoLinks1);
	$smarty->assign('keywordsRandInfoLinks2',$keywordsRandInfoLinks2);
	$smarty->assign('keywordsRandInfoLinks3',$keywordsRandInfoLinks3);
	$smarty->assign('keywordsRandInfoLinks4',$keywordsRandInfoLinks4);
	$smarty->assign('keywordsRandInfoLinks5',$keywordsRandInfoLinks5);
	$smarty->assign('keywordsRandInfoLinks6',$keywordsRandInfoLinks6);
	//$smarty->assign('keywordsList',$keywordsList);
	$smarty->assign('keywordsListLinks',$keywordsListLinks);
	$smarty->assign('keywordsListLinkss',$keywordsListLinkss);
	$smarty->assign('keywords',$keywords);
	$smarty->assign('pagecode',$pagecode);
}
$smarty->display('m_keywords_list.html',$cache_id);
//$smarty->display('m_keywords_list.html');



?>