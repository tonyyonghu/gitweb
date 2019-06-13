<?php
header("Content-type: text/html; charset=utf-8"); 

define('ACC',true);
require('./includes/init.php');

/*
调用一个keywords,根据keyword组合成标题，伪原创的内容
暂时动态，后面考虑伪静态

*/

//id的合法性
$id = isset($_GET['id'])?$_GET['id'] + 0:0;

$keywordsModel = new keywordsModel();
$keywordInfo = $keywordsModel->keywordsInfo($id);
//print_r($keyword);
//var_dump($keywordsModel);
//如果id出错
if($id <= 0 || empty($keywordInfo)){
	@header("http/1.1 404 not found");
	@header("status: 404 not found");
	include("./view/404.html");
	exit();
}

/*preg_match_all("/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/x","Call 555-1212 or 1-800-555-1212", $phones);
print_r($phones);
exit;*/

//bing.com搜索结果
$web_key = $keywordInfo['keyword'];
$key_id = $keywordInfo['id'];
//echo $web_key;
//echo $key_id;
//$keyid = urlencode(iconv("gbk","utf-8",$web_key));
$keyid = urlencode($web_key);
$url = 'http://www.bing.com/search?q='.$keyid.'&qs=n&form=QBLH&pq='.$keyid.'&sc=8-3&sp=-1&sk=';
//$url = 'http://www.baidu.com';
//$url = 'http://cn.bing.com/search?q='.$keyid.'&qs=n&form=QBLH&pq='.$keyid.'&sc=0-2&sp=-1&sk=';

//echo $url;
//$file_content = file_get_contents($url);

$ejcode="Referer: http://cn.bing.com/\r\nUser-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)";
$opts=array("http"=>array("method"=>"GET","header"=>$ejcode));
$context=@stream_context_create($opts);
//var_dump($context);exit;
//$url="http://cn.bing.com/search?q=".$keyid."";
//$url = 'http://www.baidu.com';
//echo $url;

$urlcn="http://cn.bing.com/search?q=".$keyid."";
//$urlcn = 'http://1017.88yx.com/search.php?keyword='.$keyid;

//$urlcn = 'http://so.u3366.com/search.php?keyword='.$keyid;
//echo $urlcn .'<br />';



$new_webkey=cn_substr_utf8($web_key,3,0);
//取出一个数组单元随机截取然后插入一个keywords 拼接，内链
//或者插入一个外链
//如果蜘蛛爬取  bing 会不会封禁
//getaddrinfo failed: 不知道这样的主机

//获取bing相关搜索词
function get_bingkey($file_content){
	//preg_match('|<div class="sw_menu">(.*?)</ul></div>|is',$file_content,$xgso);
	//preg_match('|<ul class="b_vList">(.*?)</ul>|is',$file_content,$xgso);
	preg_match('|<ol id="b_results">(.*?)</ol>|is',$file_content,$xgso);
	//preg_match('|<div class="b_rich">(.*?)</ul></div>|is',$file_content,$xgso);
	$weburls = array();
	preg_match_all('|<a\s+target="_blank"\s+href="(.*?)"\s+h="(.*?)">(.*?)</a>|is',$xgso[1],$weburls);
	//print_r($xgso);
	//print_r($weburls);
	//exit;
	$ids=count($weburls[3]);
	$keys='';
	for($i=0;$i<$ids;$i++) {
	//$urlid=iconv("utf-8","gbk",preg_replace('@<(.*?)>@','',$weburls['2'][$i]));
	$urlid=preg_replace('@<(.*?)>@','',$weburls['3'][$i]);
	if(trim($urlid)!="关闭屏幕取词") $keys.=$urlid."\n";
	}
	//print_r($keys);exit;
	$mykeys=explode("\n",trim($keys));
	//print_r($mykeys);
	//exit;
	if($mykeys){
	shuffle($mykeys);//随机排列数组
	$mykeys=array_flip(array_flip($mykeys));
	}
	//print_r($keys);
	//print_r($mykeys);
	//exit;
	return $mykeys;
}

//var_dump(get_bingkey($urlcn));




//数组拼接成正文
function contentHtml($arr,$keywordInfos){
	/*foreach($contentArray as $k=>$v){
		$arr .= $v;
	}
	return $arr;*/
	//var_dump($arr);
	$pic = new picModel();
	//$pic = $pic->getPic(1);
	$num = rand(2,3);
	//echo $num;
	$count = $pic->picCount();//获取数据库图片总张数
	//echo $count;
	//print_r($count);exit;
	//var_dump($count['count']);exit;
	//echo $count.'<br />';
	$pid = rand(1,$count-$num);
	
	//echo $pic->picCount().'<br />';
	//echo $pid.'<br />';
	//echo $num;
	$pic = $pic->getPics($pid,$num);//随机取得num张图片的路径
	//print_r($pic);exit;
	foreach($pic as $k=>$v){
		foreach($v as $kk=>$vv){
			$img[$k] = $vv; 
			//echo $vv;
			//$img[$k] = '<p><img src="'.$vv.'" alt="" /></p>'; 
		}
	}
	
	//随机取出1-3个关键词，并插入
	/*$keysNum = rand(1,3);
	
	$keywordsModel = new keywordsModel();
	$keywordInfos = $keywordsModel->keywordsInfos($keysNum);*/
	foreach($keywordInfos as $k=>$v){
		
		//echo $keywordInfos[$k]['id'].'<br />';
		//$keysUrl[$k] = '<a href="keywords.php?id='. $keywordInfos[$k]['id'] .'" target="_blank">'. $keywordInfos[$k]['keyword'] .'</a>';
		//$keysUrl[$k] = '<a href="/keywords.php?id='. $keywordInfos[$k]['id'] .'" target="_blank"><strong>'. $keywordInfos[$k]['keyword'] .'</strong></a>';
		//echo $k;
		$keysUrl[$k] = '<strong>'. $keywordInfos[$k]['keyword'] .'</strong>';
		//echo $keysUrl[$k].'<br />';
	}
	
	$arrContent = array();
	if($arr){
		//$arrContent[0] = 'img1'.$arr[0].$arr[4].$arr[8].'<font color="red">加粗关键词</font>'.'img2';
		$arrContent[0] = '<p><img src="/'.$img[0].'" alt="'.$keywordInfos[0]['keyword'].'" /></p>'.keyIn($arr[0].$arr[4].$arr[8],$keysUrl[0]);
		//$arrContent[1] = $arr[1].$arr[5].'<font color="red">内链1</font>'.'img3';
		//$arrContent[1] = keyIn($arr[1].$arr[5],'<font color="red">内链1</font>').'<p><img src="'.$img[1].'" alt="" /></p>';
		$keywordInfos[1]['keyword'] = $keywordInfos[1]['keyword']?$keywordInfos[1]['keyword']:$keywordInfos[0]['keyword'];
		$arrContent[1] = $img[1]?keyIn($arr[1].$arr[5],$keysUrl[1]).'<p><img src="/'.$img[1].'" alt="'.$keywordInfos[1]['keyword'].'" /></p>':keyIn($arr[1].$arr[5],$keysUrl[1]);
		//$arr[6]=keyIn($arr[6].$arr[9],'<font color="red">加粗关键词2</font>')
		$arrContent[2] = keyIn($arr[2].$arr[6].$arr[9],$keysUrl[2]);
		$arrContent[3] = $img[2]?'<p><img src="/'.$img[2].'" alt="'.$keywordInfos[1]['keyword'].'" /></p>'.keyIn($arr[3].$arr[7],'<strong>'.$keywordInfos[2]['keyword'].'</strong>'):keyIn($arr[3].$arr[7],'<strong>'.$keywordInfos[3]['keyword'].'</strong>');
		
	}
	//print_r($arrContent);
	foreach($arrContent as $v){
		$Content .= $v."\n";
	}
	//echo $Content;exit;
	return $Content;
}


//随机位置插入关键词
function keyIn($str,$key){
	$len = mb_strlen($str,'utf-8');
	$k = mt_rand(0,$len);

	$strkey = "<p style='text-indent:2em;'>";
	$strkey .= mb_substr($str,0,$k,'utf-8')."<strong>".trim($key)."</strong>";
	$strkey .= mb_substr($str,$k,$len-$k,'utf-8')."</p>";
	
	return $strkey;
}


	
//获取bing搜索结果 标题+描述
/*function cacheArray($a)
{
    $b = $a;
    $arr= array( );
    //preg_match_all( "|<div class=\"sb_tlst\"><h3><a(.*?)>(.*?)</a></h3></div>.*?<span class=\"c_tlbxTrg\">(.*?)</p>|is", $b, $m);
    preg_match_all('|<div class="sb_tlst[^"]*"><h3><a(.*?)>(.*?)</a></h3></div>.*?<p>(.*?)</p>|is',$b,$m);
	//print_r($m);
    if(count($m[1]))
    {
        $i = 0;
        foreach($m[1] as $k =>$v)
        {
            //$arr[$i] = iconv("utf-8","gbk",preg_replace("@<(.*?)>@","",$m[3][$i])).iconv("utf-8","gbk",preg_replace("@<(.*?)>@","",$m[4][$i]));
			$arr[$i] = preg_replace("@<(.*?)>@","",$m[3][$i]).preg_replace("@<(.*?)>@","",$m[2][$i]);
			$i = $i+1;
        }
    }
    shuffle(&$arr);
    //var_export($arr);
	//print_r($arr);
    return $arr;
}*/
//获取bing搜索结果 标题+描述
function cacheArray($a)
{
    $b = $a;
    $arr= array( );
    //preg_match_all( "|<div class=\"sb_tlst\"><h3><a(.*?)>(.*?)</a></h3></div>.*?<span class=\"c_tlbxTrg\">(.*?)</p>|is", $b, $m);
    //preg_match_all('|<li class="b_algo[^"]*"><h2><a(.*?)>(.*?)</a></h2>.*?<p>(.*?)</p>|is',$b,$m);
	preg_match_all('|<li class="b_algo"><h2><a(.*?)>(.*?)</a></h2><div class="b_caption"><p>(.*?)</p>|is',$b,$m);
	//print_r($m);
	//var_dump($m[1]);
    if(count($m[1]))
    {
        $i = 0;
        foreach($m[1] as $k =>$v)
        {
            //$arr[$i] = iconv("utf-8","gbk",preg_replace("@<(.*?)>@","",$m[3][$i])).iconv("utf-8","gbk",preg_replace("@<(.*?)>@","",$m[4][$i]));
			//$arr[$i] = preg_replace("@<(.*?)>@","",$m[3][$i]).preg_replace("@<(.*?)>@","",$m[2][$i]);
			$arr[$i] = preg_replace("@<(.*?)>@","",$m[2][$i])."。".preg_replace("@<(.*?)>@","",$m[3][$i]);
			$i = $i+1;
        }
    }
    shuffle($arr);
    //var_export($arr);
	//print_r($arr);
    return $arr;
}


//随机取10个关键字
function keywordsRand($keysNum){
	$keywordsModel = new keywordsModel();
	$keywordInfos = $keywordsModel->keywordsInfos($keysNum);
	//echo 'keywords10';
	//print_r( $keywordInfos);
	return $keywordInfos;
}


//随机取10个关键字
function keywordsRandText($keysNum){
	$keywordsModel = new keywordsModel();
	$keywordInfos = $keywordsModel->keywordsInfos($keysNum);
	foreach($keywordInfos as $k=>$v){
		$keywordInfosText[] = $v['keyword'];
	}
	echo "<br >" ;
	//print_r($keywordInfosText);
	return $keywordInfosText;
}



	$cache_id = substr(md5('view-' . $id),0,12);
	$smarty->clearCache(null,$cache_id);//清除缓存
	
	if(!$smarty->isCached('keywords_view.html',$cache_id)){
		$file_content=file_get_contents($urlcn,true,$context);
		//print_r($file_content);
		$contentArray = cacheArray($file_content);
		$keysNum = rand(3,3);
		//echo $keyNum;
		$keywordsModel = new keywordsModel();
		$keywordInfos = $keywordsModel->keywordsInfos($keysNum);
		
		$likekeyword=$keywordsModel->getMoreKeywords($new_webkey);
		$count=count($likekeyword);
		if($count>1)
		{
			foreach($likekeyword as $k=>$v)
			{
				if($web_key==$likekeyword[$k]['keyword']){
					
					$likekeyword[$k]=null;
				}
			}
		}
		if($count==1){
			$likekeyword=null;
		}
		$keywordInfos[3]['id']=$keywordInfo['id'];
		$keywordInfos[3]['keyword']=$keywordInfo['keyword'];
		
	//print_r($contentArray);
	//$contentArray = null;

		
	if($contentArray == null){
		$contentArrayRand = keywordsRand(100);
		foreach($contentArrayRand as $v){
			$contentArray[] = $v['keyword'];
		}
		$content = implode(' ',$contentArray);
		$content = '<p>' .$content. '</p>' .$COPYRIGHT;
	}else{
		$content = contentHtml($contentArray,$keywordInfos);
		$content .= $COPYRIGHT;
	}


	$keywordsRandInfo = keywordsRand(10);

	$mykeys = get_bingkey($file_content);
	//print_r($mykeys);
	if(count($mykeys) < 8){
		$mykeys = keywordsRandText(8);
	}
	//print_r($mykeys);
	//url
	//print_r($keywordsRandInfo);
	$links = array();
	$i=0;
	foreach($keywordsRandInfo as $v){
		$temp_id = $v['id'];
		//echo $temp_id ;
		eval("\$filename = \"$filename_template\";");
		//echo $filename .'<br />';
		$links[$i]['link'] = $filename;
		//$links[$i]['link'] = 'view-'.$v['id'];
		$links[$i]['name'] = $v['keyword'];
		$i++;
	}
	//print_r($links);
	//exit;

	//内页连接
	$keywordsRandLinks = keywordsRand($LINKVIEWNUM);
	//$keywordsRandLinks1 = keywordsRand(12);
	//$keywordsRandLinks2 = keywordsRand(30);


	$i = 0;
	foreach($arr_host as $k=>$v){
		$linkDomain[$i] = 'http://m.'.$k;
		//$linkIndex[$i]['sitename'] = $v['sitename'];
		$i++;
	}
	$linkViewTmp = array_rand($linkDomain,$LINKINDEXOTHERNUM);
	foreach($linkViewTmp as $k=>$v){
		$linkDomainRand[] = $linkDomain[$v];
		//echo $linkDomain[$v];
	}


	//print_r($linkDomainRand);exit;
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

	//文章下部
	//var_dump($linksView);exit;
	//print_r($linkDomainRand);exit;
	/* $i=0;
	foreach($keywordsRandLinks1 as $v){
		$temp_id = $v['id'];
		//echo $temp_id ;
		eval("\$filename = \"$filename_template\";");
		//echo $filename .'<br />';
		$linksView1[$i]['link'] = $linkDomainRand[$i].$filename;
		//$links[$i]['link'] = 'view-'.$v['id'];
		$linksView1[$i]['name'] = $v['keyword'];
		$i++;
	}
	 */
	/* $i=0;
	foreach($keywordsRandLinks2 as $v){
		$temp_id = $v['id'];
		//echo $temp_id ;
		eval("\$filename = \"$filename_template\";");
		//echo $filename .'<br />';
		$linksView2[$i]['link'] = $linkDomainRand[$i].$filename;
		//$links[$i]['link'] = 'view-'.$v['id'];
		$linksView2[$i]['name'] = $v['keyword'];
		$i++;
	} */









	//print_r($linksView);

	//keywordInfoLink
	$keywordInfoLink = array();
	$temp_id = $keywordInfo['id'];
	eval("\$filename = \"$filename_template\";");
	$keywordInfoLink['link'] = $filename;
	$keywordInfoLink['name'] = $keywordInfo['keyword'];

	//print_r($keywordInfoLink);
	$smarty->assign('title',$title);
	$smarty->assign('keywordInfo',$keywordInfo);
	$smarty->assign('keywordInfoLink',$keywordInfoLink);
	$smarty->assign('content',$content);
	$smarty->assign('keywordsRandInfo',$keywordsRandInfo);
	$smarty->assign('mykeys',$mykeys);
	$smarty->assign('siteIndex',$siteIndex);
	$smarty->assign('links',$links);
	$smarty->assign('linksView',$linksView);
	$smarty->assign('linksView1',$linksView1);
	$smarty->assign('linksView2',$linksView2);
	$smarty->assign("keywordInfos",$keywordInfos);

	$smarty->assign("likekeyword",$likekeyword);
	}
$smarty->display('m_keywords_view.html',$cache_id);



?>