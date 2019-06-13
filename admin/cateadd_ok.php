<?php
define('ACC','admin');
require('../includes/init.php');


// cateadd_ok.php

$data = array();

$data['cat_name'] = trim($_POST['cat_name']);

if($data['cat_name'] == '') {
    echo '栏目名不能为空';
    exit;
}

$data['parent_id'] = $_POST['parent_id'] + 0;
if($data['parent_id'] < 0) {
    $data['parent_id'] = 0;
}


$cateModel = new cateModel();

if($cateModel->catAdd($data)) {
    echo '栏目添加成功';
    exit;
} else {
    echo '栏目添加失败';
    exit;
}

