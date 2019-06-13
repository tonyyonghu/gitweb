<?php
defined('ACC')||exit('Access denied');

// 所有xxModel的父类
class Model {
    protected $db = false;

    public function __construct() {
        $this->db = mysql::getIns();
    }

}


