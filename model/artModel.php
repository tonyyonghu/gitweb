<?php
defined('ACC')||exit('Access denied');

class artModel {
    protected $table = 'art';
    protected $db = false;

    public function __construct() {
        $this->db = mysql::getIns();
    }

    public function getTop($n) {
        $sql = 'select * from art limit ' . $n;
        return $this->db->getAll($sql);
    }
}


