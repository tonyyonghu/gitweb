<?php
header("Content-type: text/html; charset=utf-8"); 

define('ACC',true);
require('./includes/init.php');
$page = isset($_GET['page'])?$_GET['page']+0:0;
//随机取10个关键字
function keywordsRand($keysNum){
	$keywordsModel = new keywordsModel();
	$keywordInfos = $keywordsModel->keywordsInfos($keysNum);
	//echo 'keywords10';
	return $keywordInfos;
}


//$smarty->clear_cache("m_keywords_index.html");

if(!$smarty->isCached('m_keywords_index.html',$_SERVER['REQUEST_URI'])) {
	$keywordsModel = new keywordsModel();
	$keywordsRandInfo = keywordsRand(15);
	$keywordsRandInfo1 = keywordsRand(15);
	
	$keywordsRandInfo2 = keywordsRand(20);
	$keywordsRandInfo3=keywordsRand(30);
	$keywordsRandInfo4=keywordsRand(30);
	$keywordsRandInfo5=keywordsRand(30);
	$keywordsRandInfo6=keywordsRand(30);
	
	$keywordsRandIndex = keywordsRand(20);
	
	$keywordsRandIndex1 = keywordsRand(50);
	$keywordsRandIndex2 = keywordsRand(50);
	$keywordsRandIndex3 = keywordsRand(5);

	// 计算栏目下的商品总量
	$total = $keywordsModel->keywordsNum();
	$perpage = 20;

	// 产生分页效果
	$page = new page($total,$perpage);
	$pagecode = $page->show();

	// 算偏移量 ,(页码-1)* perpage
	$offset = ($page->curr() - 1) * $perpage;


	$keywordsList = $keywordsModel->keywordsAll($offset,$perpage);
	//print_r($keywordsList);
	$keywords = array();
	foreach($keywordsList as $v){
		$keywords[] = $v['keyword'];
	}
	//print_r($keywords);
	/*$titile= '百家乐怎么玩_网上百家乐_真人百家乐_百家乐玩法_百家乐游戏';
	$keys= '百家乐,网上百家乐,真人百家乐,百家乐怎么玩,百家乐玩法,百家乐翻天';
	$description = '网上真人百家乐收集整理百家乐怎么玩,百家乐玩法,百家乐规则,百家乐技巧,澳门百家乐,百家乐开户,玩百家乐游戏就上百家乐翻天.';
	*/
	/*$titile= ;
	$keys= ;
	$description = ;*/
	
	
	//keywordsListLinks
	$keywordsListLinks = array();
	$i=0;
	foreach($keywordsList as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsListLinks[$i]['link'] = $filename;
	$keywordsListLinks[$i]['name'] = $v['keyword'];
	$i++;
	}
	//keywordsListLinks
	$keywordsRandIndexLinks = array();
	$i=0;
	foreach($keywordsRandIndex as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandIndexLinks[$i]['link'] = $filename;
	$keywordsRandIndexLinks[$i]['name'] = $v['keyword'];
	$i++;
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
	
	//keywordsListLinks
	$keywordsRandIndexLinks2 = array();
	$i=0;
	foreach($keywordsRandIndex2 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandIndexLinks2[$i]['link'] = $filename;
	$keywordsRandIndexLinks2[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//keywordsListLinks
	$keywordsRandIndexLinks3 = array();
	$i=0;
	foreach($keywordsRandIndex3 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandIndexLinks3[$i]['link'] = $filename;
	$keywordsRandIndexLinks3[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	
	//keywordsRandInfo2Links
	$keywordsRandInfo2Links = array();
	$i=0;
	foreach($keywordsRandInfo2 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandInfo2Links[$i]['link'] = $filename;
	$keywordsRandInfo2Links[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//keywordsRandInfo3Links
	$keywordsRandInfo3Links = array();
	$i=0;
	foreach($keywordsRandInfo3 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandInfo3Links[$i]['link'] = $filename;
	$keywordsRandInfo3Links[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//keywordsRandInfoLinks
	$keywordsRandInfo4Links = array();
	$i=0;
	foreach($keywordsRandInfo4 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandInfo4Links[$i]['link'] = $filename;
	$keywordsRandInfo4Links[$i]['name'] = $v['keyword'];
	$i++;
	}
	//keywordsRandInfoLinks
	$keywordsRandInfo5Links = array();
	$i=0;
	foreach($keywordsRandInfo5 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandInfo5Links[$i]['link'] = $filename;
	$keywordsRandInfo5Links[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	//keywordsRandInfoLinks
	$keywordsRandInfo6Links = array();
	$i=0;
	foreach($keywordsRandInfo6 as $v){
	$temp_id = $v['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordsRandInfo6Links[$i]['link'] = $filename;
	$keywordsRandInfo6Links[$i]['name'] = $v['keyword'];
	$i++;
	}
	
	
	
	
	
	$linkDomain=array();
	//外链链接
	$keywordsRandLinks = keywordsRand($LINKINDEXOTHERNUM);
	$i = 0;
	foreach($arr_host as $k=>$v){
		$linkDomain[$i] = 'http://m.'.$k;
		//$linkIndex[$i]['sitename'] = $v['sitename'];
		
		$i++;
	}
	//print_r($linkDomain);//array(0=>'http://m.d.com',1=>'http:m.e.com');
	$linkViewTmp=array_rand($linkDomain,$LINKINDEXOTHERNUM);

	foreach($linkViewTmp as $k=>$v){
		$linkDomainRand[] = $linkDomain[$v];
	}

	$i=0;
	foreach($keywordsRandLinks as $v){
		$temp_id = $v['id'];
		//echo $temp_id ;
		eval("\$filename = \"$filename_template\";");
		//echo $filename .'<br />';
		$linksView[$i]['link'] = $linkDomainRand[$i].$filename;
		//$links[$i]['link'] = 'view-'.$v['id'];
		$linksView[$i]['name'] = $v['keyword'];
		$i++;
	}
	//print_r($linksView);

	$linkIndex=array();
	//首页连接
	$i = 0;
	foreach($arr_host as $k=>$v){
		//echo $k."<br />";
		$linkIndex[$i]['host'] = 'http://m.'.$k;
		$linkIndex[$i]['sitename'] = $v['sitename'];
		$i++;
		//echo $i;
	}
	//var_dump( $linkIndex[0]['host']);echo "<br />";
	print_r($linkIndex);
	$linkIndexTmp = array_rand($linkIndex,$LINKINDEXOTHERNUM);
	
	//print_r($linkIndexTmp);
	foreach($linkIndexTmp as $k=>$v){
		$linkIndexRand[] = $linkIndex[$v];
	}
	//print_r($linkIndexRand);exit;
	
	$suiji_keywords=$keywords[mt_rand(0,19)];

	$smarty->assign('suiji_keywords',$suiji_keywords);
	
	
	$smarty->assign('sitename',$sitename);
	$smarty->assign('title',$title);
	// $smarty->assign('keys',$keys);
	// $smarty->assign('description',$description);
	
	$smarty->assign('keywordsRandInfo',$keywordsRandInfo);
	$smarty->assign('keywordsRandInfo1',$keywordsRandInfo1);
	//$smarty->assign('keywordsRandInfo2',$keywordsRandInfo2);
	$smarty->assign('keywordsRandInfo2Links',$keywordsRandInfo2Links);
	$smarty->assign('keywordsRandInfo3Links',$keywordsRandInfo3Links);
	$smarty->assign('keywordsRandInfo4Links',$keywordsRandInfo4Links);
	$smarty->assign('keywordsRandInfo5Links',$keywordsRandInfo5Links);
	$smarty->assign('keywordsRandInfo6Links',$keywordsRandInfo6Links);
	//$smarty->assign('keywordsList',$keywordsList);
	$smarty->assign('keywordsListLinks',$keywordsListLinks);
	//$smarty->assign('keywordsRandIndex',$keywordsRandIndex);
	$smarty->assign('keywordsRandIndexLinks',$keywordsRandIndexLinks);
	$smarty->assign('keywordsRandIndexLinks1',$keywordsRandIndexLinks1);
	$smarty->assign('keywordsRandIndexLinks2',$keywordsRandIndexLinks2);
	$smarty->assign('keywordsRandIndexLinks3',$keywordsRandIndexLinks3);
	
	$smarty->assign('keywords',$keywords);
	$smarty->assign('siteIndex',$siteIndex);
	$smarty->assign('linksView',$linksView);
	$smarty->assign('linkIndex',$linkIndexRand);
}
$smarty->display('m_keywords_index.html');



?>