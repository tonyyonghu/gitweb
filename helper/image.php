<?php
defined('ACC')||exit('Accecss Denied');

// 图片处理类

/****
要求
生成缩略图
加水印
****/

/*
内部的函数相互调用的情况少,
耦合性低,
大部是调用系统的gd函数,
即:函数各自孤立
*/

class image {
    static protected $error = '';

    // 分析图片信息
    static public function getImgInfo($img) {
        if(!file_exists($img)) {
            self::$error = '图片不存在';

            return false;
        }

        $imgInfo = getimagesize($img); // 获取图片信息,宽高,类型信息,不受gd库的影响
        
        if($imgInfo === false) {
            self::$error = '无法正确读取图片信息';
            return false;
        }
        
        // print_r($imgInfo);
        
        $info = array();
        $info['width'] = $imgInfo[0];
        $info['height'] = $imgInfo[1];
        $info['type'] = image_type_to_extension($imgInfo[2],false);
        $info['mime'] = $imgInfo['mime'];

        return $info;

    }

    // 生成缩略图
    static public function thumb($ori,$width=230,$height=230) {
        $info = self::getImgInfo($ori);
        if($info === false) {
            return false;
        }

        // 至此,原始图片正常读取,接下来考虑缩略的问题.
        $scale = min($width/$info['width'],$height/$info['height']); // 计算缩小比例

        $tw = floor($scale * $info['width']); // 计算小图的宽
        $th = floor($scale * $info['height']); // 计算小图的高.

        $thumb = imagecreatetruecolor($width,$height); // 按参数创建画布
        
        // 小图补白
        $white = imagecolorallocate($thumb,255,255,255);
        imagefill($thumb,0,0,$white);

        // 计算缩略时的偏移量
        $offsetX = floor(($width - $tw) / 2);
        $offsetY = floor(($height - $th) / 2);

        // 把大图读出来
        $createFun = 'imagecreatefrom' . $info['type'];
        $src = $createFun($ori);

        // 生成缩略小图
        imagecopyresampled($thumb,$src,$offsetX,$offsetY,0,0,$tw,$th,$info['width'],$info['height']);
        

        // 生成图片并保存
        $imageFun = 'image' . $info['type']; // 计算生成所用的函数名

        if($width == 230) {
            $newimg = str_replace('.','_goods.',$ori); // 生成缩略图的路径
        } else if($width == 100) {
            $newimg = str_replace('.','_thumb.',$ori); // 生成100的缩略图路径
        } else {
            $newimg = $ori;
        }
        
        
        //header('Content-type: ' . $info['mime']);
        if(!$imageFun($thumb,$newimg)) { // 生成并保存图片
            self::$error = '生成图片失败';
            return false;
        } else {
            /*
            if($width == 230){
                $logo = ROOT.'data/logo.gif';
                self::water($logo,$newimg,$offsetX,$offsetY);
            }*/

            @imagedestroy($thumb); // 屏蔽函数有可能产生的错误
            @imagedestroy($src);

            return ltrim(str_replace(ROOT,'',$newimg),'/');
        }

        

        

    }

    // 加水印的方法, 同学们自行完成
    static public function water($logo,$dct,$offsetX,$offsetY){
        $src_res = self::getImgInfo($logo);
        $dct_res = self::getImgInfo($dct);

        if($src_res === false || $dct_res === false){
            return false;
        }
        //创建logo资源的方法
        $createSRC = 'imagecreatefrom'.$src_res['type'];

        $src_r = $createSRC($logo);
        //创建要打水印的图片的方法
        $createIMG = 'imagecreatefrom'.$dct_res['type'];
        $dct_r = $createIMG($dct);
        
        //水印需要的偏移量
        $px = $dct_res['width'] - $src_res['width'] - $offsetX;

        $py = $dct_res['height'] - $src_res['height'] - $offsetY;

//imagecopymerge ($dst_im ,$src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )
        imagecopymerge($dct_r,$src_r,$px,$py,0,0,$src_res['width'],$src_res['height'],40);
        //根据资源的type信息,创建保存图片的方法
        $createIMG = 'image'.$dct_res['type'];
        //用刚才创建的方法,保存图像
        $createIMG($dct_r,$dct);
        @imagedestroy($dct_r);
        @imagedestroy($src_r);
    }

    static protected function randStr($length = 0){
        if($length <= 0) {
            return '';
        }

        $source = 'abcdefghijimnpqrstuvwxyzABCDEFGHIJIMNPQRSTUVWXYZ23456789';
        
        $str = '';
        for($i=0;$i<$length; $i++) {
            $str .= ' '.substr($source,rand(0,55),1);
        }

        return $str;
    }

    static public function chkcode($n=4) {
        // 创建画布
        $im = imagecreatetruecolor(60,25);

        $code = imagecreatetruecolor(60,25);

        // 造颜料
        $gray = imagecolorallocate($im,128,128,128);
        $blue = imagecolorallocate($im,0,0,255);

        // 填充
        imagefill($im,0,0,$gray);
        imagefill($code,0,0,$gray);

        // 写字
        imagestring($im,4,-5,5,self::randStr($n),$blue);
        // 扭
        /*
        验证码字符扭曲不强求,
        但是要能做到:生成验证+干扰线的效果
        */
        $fz = 2; //上下波动最大3像素
        $t = 20; // 扭动周期,20像素扭动一个周期.

        for($i=0;$i<60;$i++) {
            $y = round(sin(deg2rad(18 * ($i%40))) * $fz);
            // echo $y,'<br />';
            imagecopy($code,$im,$i,$y,$i,0,1,25);
        }
        header('Content-type: image/jpeg');
        imagejpeg($code);
    }
}

//print_r(image::getImgInfo('./home.gif'));


// image::thumb('D:/www/0409/home.gif',100,100);



// image::chkcode();



