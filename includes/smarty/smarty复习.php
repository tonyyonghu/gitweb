<?php

// 作用: 完成php与html代码的分离

/* smarty的引入:
* smarty 是一个模板类,所以和普通的类的引入没有区别
* 1:包含smarty类文件
* 2:实例化对象
*/


/*
*smarty 的典型应用流程
* 1:$smarty = new smarty();
* 2:$smarty->assign('tag','value');
* 3:$smarty->display('index.html');
*/



/*
* smarty的常用配置
* $smarty->template_dir = 'view'; //模板目录
* $smarty->compile_dir = 'data/tpl_c'; 模板编译目录
* $smarty->cache_dir = '' ; //缓存目录
* $smarty->caching = true; // 是否缓存,true,1/false,0
* $smarty->cache_lifetime ; //缓存有效期
*/

 
/*
* 基本语法与注释
* 标签 默认是{}
* 可以通过修改$smarty->left_delimiter,
* right_delimiter 定义自己的标签符号.
*/


/*
* 如何屏蔽一段js或css代码,使其不被smarty解析
* 答:在代码两端 加上{literal}{/literal}标签
*/

/*
* 注释标签
* left_delimiter* *right_delimiter
*/ 


/*
* 模板包含
* {include file="子模板文件"}
*/


/*
* 缓存的控制开关
* $smarty->caching = true,1/false,0 开启/关闭缓存
*/

/*
* 局部缓存
* 模板里{insert name="functionName"}
* 此时 ,模板的此标签处,真正打印的是 insert_functionName的返回值
* 所以,.php里,必须已经定义insert_functionName()这个函数
*/


/*
* 判断及使用缓存
* $smarty->is_cached('模板名') {
* }
*/


/*
* 清除缓存
* $smarty->clear_cache('模板名') ->删除指定模板的缓存
* $smarty->clear_all_cache ->删除全部缓存
*/


/*
* fetch 与display的不同
* fetch 返回不输出
* display  输出fetch的返回结果
*/