<?php
defined('ACC')||exit('Access denied');

class userModel extends Model {
    protected $table = 'user';

    public function __construct() {
        parent::__construct();
    }

    // 用户注册的方法
    public function reg($arr) {
        $arr['passwd'] = $this->encPass($arr['passwd']);
        return $this->db->autoExecute($arr,$this->table);
    }


    // 检验用户名是否存储,和检验用户名,密码是否匹配的方法
    public function check($u,$p='') {
        if($p) {
            $sql = "select user_id,username,email from user where username = '" . $u . "' and passwd = '" . $this->encPass($p) . "'";
            return $this->db->getRow($sql);
        } else {
            $sql = "select count(*) from user where username = '" . $u ."'";
            return $this->db->getOne($sql);
        }
    }

    // 检验用户名和email是否匹配
    public function checkemail($u,$e) {
        $sql = "select count(*) from user where username = '" . $u ."' and email = '" . $e . "'";
        // echo $sql;exit;
        return $this->db->getOne($sql);
    }

    // 密码加密的方法
    protected function encPass($str) {
        return md5($str);
    }

    // 更改密码的方法
    public function chPass($u,$p) {
        $sql = "update user set passwd = '" . $this->encPass($p) . "' where username = '" . $u . "'";
        // echo $sql;
        return $this->db->query($sql);
    }
    
}