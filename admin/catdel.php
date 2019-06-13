<?php
define('ACC','admin');
require('../includes/init.php');


// catdel.php?cat_id=N

$cat_id = $_GET['cat_id'] + 0;

if($cat_id <= 0) {
    echo '参数有误';
    exit;
}


// 实例化cateModel
$cateModel = new cateModel();



/*
此处是根据delete语句语法上的执行成功与否来判断的,不够准确
query ok, 0 rows affected
应该用影响行数来判断, mysql_afftected_rows
*/

// 判断栏目是否为空
$subtree = $cateModel->cateList($cat_id);

if(!empty($subtree)) {
    echo '栏目非空不能删除';
    exit;
}

if($cateModel->catDel($cat_id)) {
    echo '删除成功';
    exit;
} else {
    echo '删除失败';
    exit;
}



