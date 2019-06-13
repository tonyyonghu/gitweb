<?php
/* Smarty version 3.1.33, created on 2019-06-06 08:15:53
  from 'D:\phpStudy\PHPTutorial\WWW\md\view\m_keywords_view.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cf8cbb9085ae7_11478897',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe47d479984b19fe0e10309af8b1bbd8aa7ff50e' => 
    array (
      0 => 'D:\\phpStudy\\PHPTutorial\\WWW\\md\\view\\m_keywords_view.html',
      1 => 1559808852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf8cbb9085ae7_11478897 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\phpStudy\\PHPTutorial\\WWW\\md\\includes\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
$_smarty_tpl->compiled->nocache_hash = '11860556205cf8cbb904fd39_15582105';
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-transform " />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<title><?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
 <?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[1]['keyword'];?>
</title>
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
,<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[1]['keyword'];?>
,<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[2]['keyword'];?>
,<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[3]['keyword'];?>
" />
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
为你提供<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[1]['keyword'];?>
和<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[2]['keyword'];?>
相关内容,精选<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[3]['keyword'];?>
视频,<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[4]['keyword'];?>
图片,<?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[5]['keyword'];?>
资料等." />
	<link rel="Shortcut icon" href="/view/images/favicon.ico" />
	<link rel="stylesheet" href="/view/css/sm.min.css">
	<link rel="stylesheet" href="/view/css/my_style.css">
	<?php echo '<script'; ?>
 src='/view/js/zepto.min.js'><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src='/view/js/sm.min.js'><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="/view/js/swiper.min.js"><?php echo '</script'; ?>
>
	<!-- <?php echo '<script'; ?>
 src="/view/js/content.js"><?php echo '</script'; ?>
> -->

</head>
<body class="theme-1">
<div class="page-group">
		<div class="panel-overlay"></div>
	<!-- 左侧边栏 -->
	<div class="panel panel-left panel-reveal" id="panel-left-demo">
		<div class="content">
			<div class="list-block">
				<ul>
					<li class="item-content news-title no-arrow">
					<div class="item-inner">
						<div class="item-title-row">
							<div class="item-title"><b>栏目分类</b></div>
						</div>
					</div>
					</li>
					<li>
						<a href="/"  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">首 页</div>
							</div>
						</a>
					</li>
					<li class='hover'>
					<a href='/list_1_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"生物世界"),$_smarty_tpl ) );?>
.html' class='item-content item-link external' ><div class='item-inner'><div class='item-title'>生物世界</div></div></a></li>
					<li>
						<a href='/list_2_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"美女背影"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">美女背影</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_3_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"金融货币"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">金融货币</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_4_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"科学研究"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">科学研究</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_5_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"生活百科"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">生活百科</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_6_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"移门图案"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">移门图案</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_7_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"清纯美女"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">清纯美女</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_8_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"职业人物"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">职业人物</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_9_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"韩文模板"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">韩文模板</div>
							</div>
						</a>
					</li>
					<li>
						<a href='/list_10_<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['myfunc'][0], array( array('con'=>"背景底纹"),$_smarty_tpl ) );?>
.html'  class="item-content item-link external">
							<div class="item-inner">
								<div class="item-title">背景底纹</div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 右侧边栏 -->
	
	<div class="page page-current" id="router">
		<header class="bar bar-nav">
			<span class="icon icon-menu pull-left open-panel" data-panel="#panel-left-demo"></span>
			<h2 class="title title2"><?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
 <?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[1]['keyword'];?>
</h2>
		</header>
		
		<div class="content">
			<article class="art-news">
					<div class="content-padded">
						<h3 style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
 <?php echo $_smarty_tpl->tpl_vars['likekeyword']->value[1]['keyword'];?>
</h3>
						<p class="entry-meta" style="text-align:center;"><?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
<span class="pipe">|</span>编辑：<?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
</p>
						
						<div style="margin-top:10px;margin-bottom: 10px;">
							<?php echo '<script'; ?>
>ad2();<?php echo '</script'; ?>
>
						</div>
						<div class="entry-content">
						<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

						</div>
						
						<div style="margin-top:10px;margin-bottom: 10px;">
							<?php echo '<script'; ?>
>ad3();<?php echo '</script'; ?>
>
						</div>
					</div>
			</article>
			
			<div class="list-block news-list">
					<ul>
					<li>
							<a href="#" class="item-link item-content news-title no-arrow">
							<div class="item-inner">
								<div class="item-title"><b>热点阅读</b></div>
							</div>
							</a>
						</li>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linksView']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
						<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['link'];?>
" class="item-link item-content no-arrow">
							<div class="item-inner">
								<div class="item-title"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</div>
								<div class="item-after"><?php echo smarty_modifier_date_format(time(),"%d-%m");?>
</div>
							</div>
						</a>
			</li>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						
					
						<li>
							<a href="#" class="item-link item-content news-title no-arrow">
							<div class="item-inner">
								<div class="item-title"><b><?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
相关资料</b></div>
							</div>
							</a>
						</li>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['links']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
						<li>
						<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['link'];?>
" class="item-link item-content no-arrow">
							<div class="item-inner">
								<div class="item-title"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</div>
								<div class="item-after"><?php echo smarty_modifier_date_format(time(),"%d-%m");?>
</div>
							</div>
						</a>
			</li>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul>
				</div>
			
			<footer class="content-block-title center">
				<p><a href="<?php echo $_smarty_tpl->tpl_vars['siteIndex']->value['mdomain'];?>
" class="gray">手机版</a><span class="pipe">|</span><a href="<?php echo $_smarty_tpl->tpl_vars['siteIndex']->value['domain'];?>
" class="gray">电脑版</a></p>
				<p>&copy;2017 <?php echo $_smarty_tpl->tpl_vars['keywordInfo']->value['keyword'];?>
 <?php echo $_smarty_tpl->tpl_vars['siteIndex']->value['domain'];?>
, All rights reserved.</p>
				<div style="display:none;"><?php echo '<script'; ?>
 type="text/javascript" src="https://s23.cnzz.com/z_stat.php?id=1274739193&web_id=1274739193"><?php echo '</script'; ?>
></div>
	
			</footer>
		</div>
		
		
		
		
	</div>
	
</div>
	
</body>
</html><?php }
}
