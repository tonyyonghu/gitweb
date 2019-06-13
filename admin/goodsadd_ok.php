<?php
define('ACC','admin');
require('../includes/init.php');


/*
思路:
1:接收POST数据
判断商品名为空,货号是否为空,栏目是否选中

2:把收到的POST的形成数组, 数组的键名与字段一一匹配

// 2.5: 上传图片, 
   1:判断后缀,防止exe,等
   2:判断大小
   3:按年月生成目录
   4:生成随机文件名


3:调用model的相关方法,插入商品信息


*/

/*
在controller里,要对数据进行充分的检验
*/


$data = array(); // 空数组,用来接收POST

$data['goods_name'] = trim($_POST['goods_name']);

if($data['goods_name'] == '') {
    echo '请填写商品名称';
    exit;
}

/*$data['goods_sn'] = trim($_POST['goods_sn']);
if($data['goods_sn'] == '') {
    // 调用某函数来生成不重复的货号
}
*/

$data['goods_sn'] =  

$data['cat_id'] = $_POST['cat_id'] + 0;

if(!$data['cat_id']) {
    echo '请选择栏目';
    exit;
}


/*****
上传商品图片
******/

// print_r($_FILES);exit;
/*
if(!empty($_FILES['ori_img']) && $_FILES['ori_img']['error'] == 0) {


    $ext = get_ext($_FILES['ori_img']['name']);
    if(!check_ext($ext)) {
        echo '此文件类型不允许上传';
    }
        

    
    // 根据日期生成目录
    $dir = mk_dir();

    // 创建随机文件名
    $picname = rand_name();

    $path = $dir . '/' . $picname . '.' . $ext;

    if(move_uploaded_file($_FILES['ori_img']['tmp_name'],$path)) {
        // 把路径信息写入到$data数组
        $data['ori_img'] = ltrim(str_replace(ROOT,'',$path),'/');
    }


    
    //print_r($data);exit;
}
*/

$upfile = new upfile(2,'jpeg,jpg,gif,png,bmp');
$data['ori_img'] = $upfile->up('ori_img'); // 路径或false


/*
生成缩略图
*/
if($data['ori_img']) {  // 判断是否上传了图片
    $data['goods_img'] = ltrim(str_replace(ROOT,'',image::thumb(ROOT . '/' . $data['ori_img'],230,230)),'/');

    /****
    此处针对 230*230的图加水印
    ****/

    $data['thumb_img'] = ltrim(str_replace(ROOT,'',image::thumb(ROOT . '/' . $data['ori_img'],100,100)),'/');
}




// 商品价格
$data['shop_price'] = $_POST['shop_price'] + 0.0;

// 市场价格
$data['market_price'] = $_POST['market_price'] + 0.0;

// 库存量
$data['goods_number'] = $_POST['goods_number'] + 0;

// 商品重量(转化为kg)
$data['goods_weight'] = $_POST['goods_weight'] * $_POST['weight_unit'];

// 商品简短描述
$data['goods_brief'] = trim($_POST['goods_brief']);

// 商品详述描述
$data['goods_desc'] = trim($_POST['goods_desc']);

// 是否上架
$data['is_on_sale'] = isset($_POST['is_on_sale'])?1:0;

// 是否精品,热卖,新品
$data['is_best'] = isset($_POST['is_best'])?1:0;
$data['is_new'] = isset($_POST['is_new'])?1:0;
$data['is_hot'] = isset($_POST['is_hot'])?1:0;

// 商品的添加时间 
$data['add_time'] = time();


// 把形成的数组传model, goodsModel

$goodsModel = new goodsModel();

// 生成货号
$data['goods_sn'] = $goodsModel->createSn(trim($_POST['goods_sn']));

if($newid = $goodsModel->goodsAdd($data)) {
    echo '发布商品成功,商品id是',$newid;
} else {
    echo '发布商品失败';
}

?>