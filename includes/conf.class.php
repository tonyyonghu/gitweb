<?php

// 配置文件的读取类
// 作用是读取config.php,并能返回某个配置选项的值


class conf {
    private static $ins = false;
    private $info = array();

    final protected function __construct() {
        require(ROOT . 'includes/config.php');
        $this->info = $_cfg;
    }

    final protected function __clone() {
    }

    public static function getIns() {
        if(self::$ins === false) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    public function __get($key) {
        if(array_key_exists($key,$this->info)) {
            return $this->info[$key];
        } else {
            return null;
        }
    }


    public function __set($key,$value) {
        $this->info[$key] = $value;
    }

    /*public function printc() {
        print_r($this->info);
    }*/
    
}

/*

$conf = conf::getIns();
$conf->tmp_dir = 'D:/www';

echo $conf->printc();


*/
// conf 类能正常读取和设置配置信息




