<?php
define('ACC','admin');
require('../includes/init.php');

// 删除商品页面

// 接收goods_id,
// 调用Model的方法


// 接收参数
$goods_id = $_GET['goods_id'] + 0;


// 实例化goodsModel
$goodsModel = new goodsModel;


// 调用删除方法
if($goodsModel->del($goods_id)) {
    echo '删除成功';
} else {
    echo '删除商品失败';
}


