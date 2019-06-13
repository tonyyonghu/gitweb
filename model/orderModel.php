<?php
defined('ACC')||exit('Access denied');


// 处理订单的模型层
class orderModel extends Model {
    protected $table = 'order_info';


    // 生成不重复的order_sn
    public function order_sn() {
        $sn = 'mg' . date('Ymd',time()) . rand(100000,999999);
        $sql = 'select count(*) from ' . $this->table . ' where order_sn = \'' . $sn . '\'';

        return $this->db->getOne($sql)?$this->order_sn():$sn;
    }

    // 把订单写入到order_info
    public function addOrder($data) {
        return $this->db->autoExecute($data,$this->table)?$this->db->insert_id():false; // 返回是order_id这个主键的值
    }

    // 把订单对应的商品信息写入到order_goods
    public function addGoods($data) {
        return $this->db->autoExecute($data,'order_goods')?$this->db->insert_id():false; // 插入order_good表
    }

    // 把订单对应的商品信息删掉
    public function del($order_id) {
        $sql1 = 'delete from order_goods where order_id = ' . $order_id;
        $sql2 = 'delete from order_info where order_id = ' . $order_id;

        return $this->db->query($sql1) && $this->db->query($sql2);
    }


    // 把订单的状态修改为已支付
    public function pay($order_sn) {
        $sql = "update order_info set status = 1 where order_sn = '" . $order_sn . "'";
        return $this->db->query($sql);
    }
}
