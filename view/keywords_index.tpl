<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}-{$siteIndex.sitename}</title>
<meta name="keywords" content="{$keys}" />
<meta name="description" content="{$description}" />
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<script src="http://siteapp.baidu.com/static/webappservice/uaredirect.js" type="text/javascript"></script>
<script type="text/javascript">uaredirect("{$siteIndex.mdomain}");</script>
<link href="/view/css/keywords_index1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/view/js/news1.js"></script>
</head>
<body>
	<div id="header"><div id="toolbar">
	 <div class="tool">
      <div class="left fl"><a href="{$siteIndex.mdomain}" target="_blank">手机访问</a><a href="{$siteIndex.domain}" title ="{$keys}" target="_blank">{$title}-{$siteIndex.sitename}</a></div>
	  <div class="right fr">欢迎访问{$siteIndex.sitename}</div>
     </div>
	</div>
	<div class="head">
		<div class="logo fl"><a href="{$siteIndex.domain}"><img src="/view/images/index.png" width='280' height='60' alt='{$title}-{$siteIndex.sitename}'></a></div>
		<div class="left fr">
			<div class="search fl"></div>
			<div class='right fr'><a class="s-weibo" href="javascript:vod(0);" title="关注新浪微博" onclick="s_weibo()"></a><a class="t-weibo" href="javascript:vod(0);" title="关注腾讯微博" onclick="t_weibo()"></a><a class="i-qzone" href="javascript:vod(0);" title="关注认证空间" onclick="qzone()"></a><a class="i-marks" href="javascript:vod(0);" title="加入收藏夹" onclick="favorites('{$title}-{$siteIndex.sitename}',location.href)"></a></div>
			
			<div class="cl"></div>
		</div>
	</div>
	
	<div class="subnav" >
		<div class="ad1012">
			<script src="/static/ccc1/js/960-3.js"></script>
		</div>
	</div>
	
	<div class="container list_repeat">
		<div class="container-bd list_top">
			<div class="main-wrap">
				<div class="index-item">
					<div class="item-box">
						<div class="ta"><h4>{$title}</h4></div>
						<div class="tc">
						{foreach from=$keywordsListLinks item=v}
						<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
						{/foreach}
						</div>
					</div>
					<div class="item-box">
						<div class="ta"><h4>{$siteIndex.sitename}</h4></div>
						<div class="tc">
							{foreach from=$keywordsRandIndexLinks item=v}
							<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
							{/foreach}
						</div>
					</div>
					<div class="item-box">
						<div class="ta"><h4>{$title}</h4></div>
						<div class="tc">
						{foreach from=$keywordsRandInfo3Links item=v}
						<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
						{/foreach}
						</div>
					</div>
					<div class="item-box">
						<div class="ta"><h4>{$siteIndex.sitename}</h4></div>
						<div class="tc">
							{foreach from=$keywordsRandInfo4Links item=v}
							<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
							{/foreach}
						</div>
					</div>
					
					<div class="item-box">
						<div class="ta"><h4>{$title}</h4></div>
						<div class="tc">
						{foreach from=$keywordsRandIndexLinks1 item=v}
						<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
						{/foreach}
						</div>
					</div>
					<div class="item-box">
						<div class="ta"><h4>{$siteIndex.sitename}</h4></div>
						<div class="tc">
							{foreach from=$keywordsRandIndexLinks2 item=v}
							<li><span class="time"></span><a href="{$v.link}" target="_blank" title="{$v.name}">{$v.name}</a></li>
							{/foreach}
						</div>
					</div>
				</div>
				<div class="cl"></div>
					
			</div><!--/left-->
			<div class="article_right">
				<div class="right-item">
					<div class="title"><h3>搜索{$siteIndex.sitename}的人还搜索了</h3></div>
					<div class="box">
						{foreach from=$keywordsRandInfo item=v}
						<li><span class='a b'>1</span><a target="_blank" href="/keywords_list.php?page={php}echo rand(1,100);{/php}" title="{$v.keyword}">{$v.keyword}</a></li>
						{/foreach}
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>