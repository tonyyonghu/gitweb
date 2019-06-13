<?php
defined('ACC')||exit('Access denied');

class msgModel extends Model {
    protected $table = 'msg';

    // 发布留言的方法
    public function pubMsg($data) {
         return $this->db->autoExecute($data,$this->table);
    }

    //取出留言
    public function selMsg($limit=10) {
        $sql = 'select * from msg order by pubtime desc limit ' . $limit;
        return $this->db->getAll($sql);
    }


}