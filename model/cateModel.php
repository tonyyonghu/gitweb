<?php
defined('ACC')||die('Access Denied');
// cateModel

class cateModel extends Model {
    protected $table = 'category';
    protected $cateList = array();

    // 写一个方法,负责查询所有的栏目
    public function cateList($pid = 0) {
        $sql = 'select * from category';
        $arr = $this->db->getAll($sql);
        if(!empty($arr)) {
            $this->catSort($arr,$pid,0);
        }
        
        $arr = $this->cateList;
        $this->cateList = array();
        return $arr;
    }


    // 对栏目递归排序,递归找子孙树
    public function catSort($arr,$pid=0,$lev=0) {
        foreach($arr as $v) {
            if($v['parent_id'] == $pid) {
                $v['lev'] = $lev;
                $this->cateList[] = $v;
                $this->catSort($arr,$v['cat_id'],$lev+1);
            }
        }
    }

    // 插入一个新栏目
    public function catAdd($data) {
        return $this->db->autoExecute($data,$this->table);
    }

    // 删除一个栏目
    public function catDel($cat_id) {
        $sql = 'delete from category where cat_id = ' . $cat_id;
        return $this->db->query($sql);
    }

    // 根据cat_id查询栏目信息
    public function catInfo($cat_id) {
        $sql = 'select * from category where cat_id = ' . $cat_id;
        return $this->db->getRow($sql);
    }

    //根据cat_id修改栏目信息
    public function catEdit($data,$cat_id) {
        /*
        $sql = 'update ' . $this->table ." set cat_name = '". $data['cat_name'] ."',parent_id = '" . $data['parent_id'] . "' where cat_id = " . $cat_id;
        
        return $this->db->query($sql);
        */

        return $this->db->autoExecute($data,$this->table,'update',' where cat_id = '.$cat_id);
    }

    //根据栏目cat_id寻找家谱树
    public function familyTree($arr,$cat_id) {
        static $list = array();
        foreach($arr as $v) {
            if($v['cat_id'] == $cat_id) {
                $this->familyTree($arr,$v['parent_id']);
                $list[] = $v;
            }
        }

        return $list;
    }
}


