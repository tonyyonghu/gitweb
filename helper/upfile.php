<?php
defined('ACC')||exit('Access Denied');

/*
工具类
文件名 upfile.php
类名: upfile
作用: 文件上传
*/


// 收集$_FILES的信息
// 检查文件合法性(后缀,大小)

// 创建目录

// 移动

// 错误日志


class upfile {
    public $maxSize = -1; // 上传文件的最大大小, 小于0为不限制
    public $allowExts = ''; // 允许的扩展名,为空则不限制
    protected $info = array(); // 用来放置$_FILES的信息
    protected $error = '';


    public function __construct($maxSize=2,$allowExts='') {
        $maxSize += 0;
        if($maxSize > 0) {
            $this->maxSize = $maxSize;
        }

        // 传来的allowExts可以是数组,也可以是字符串,
        // 但是最终转成数组存在
        if(!empty($allowExts)) {
            if(is_array($allowExts)) {
                $this->allowExts = array_map('strtolower',$allowExts);
            } else {
                $this->allowExts = explode(',',strtolower($allowExts));
            }
        }
    }

    public function up($name) { // $name是文件域的name值
        // 文件域不存在的错误
        if(!isset($_FILES[$name]) or !is_array($_FILES[$name])) {
            $this->error = '不存在的文件域';
            return false;
        }

        // 把上传文件数组信息放到info属性上.
        $this->info = $_FILES[$name];


        // 产生文件过大,等等错误
        $err = array(1=>'上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值',
                     2=>'上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值',
                     3=>'文件只有部分被上传',
                     4=>'没有文件被上传',
                     6=>'找不到临时文件夹',
                     7=>'文件写入失败'
        );

        if($this->info['error']) {
            $this->error = $err[$this->info['error']]; // 把数组里的错误赋给error属性;
            return false;
        }


        // 检查后缀,大小
        if(!$this->check()) {
            return false;
        }

        // 创建目录
        $path = $this->mk_dir();
        if(!$path) {
            $this->error = '创建目录失败';
            return false;
        }

        // 迭代来生成不重复的文件名
        do {
            $path = $path . '/' . $this->randName() . '.' . $this->info['ext'];
        } while(file_exists($path));

        // 移动文件
        if(!move_uploaded_file($this->info['tmp_name'],$path)) {
            $this->error = '移动文件失败';
            return false;
        } else {
            return ltrim(str_replace(ROOT,'',$path),'/'); 
        }

    }

    protected function mk_dir() {
        $path = ROOT . '/data/images/' . date('Ym',time());
        if(is_dir($path)) {
            return $path;
        }
        
        return mkdir($path,'0777',true)?$path:false;
    }

    // 生成随机文件名
    protected function randName() {
        return date('d',time()) . rand(100000,999999);
    }

    protected function check() {
        if(!$this->checkExt()) {
            $this->error = '不允许的后缀名' . $this->info['ext'];
            return false;
        }

        if(!$this->checkSize()) {
            $this->error = '文件超过' . $this->maxSize . 'M';
            return false;
        }

        return true;
    }

    protected function checkExt() {
        // 获取文件后缀名
        $this->info['ext']  = strtolower(pathinfo($this->info['name'],PATHINFO_EXTENSION));
        
        if(empty($this->allowExts)) {
            return true;
        }

        return in_array($this->info['ext'],$this->allowExts);
    }

    // 检验文件大小
    protected function checkSize() {
        if($this->maxSize <= 0) {
            return true;
        }

        return $this->maxSize * 1024 * 1024 >= $this->info['size'] ;
    }

    // 读取错误信息
    public function errMsg() {
        return $this->error;
    }
}












