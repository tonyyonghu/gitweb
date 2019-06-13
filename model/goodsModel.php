<?php
defined('ACC')||exit('Access denied');

class goodsModel extends Model {
    protected $table = 'goods';

    // 发布商品的model方法,返回刚发布的商品id,或者false
    public function goodsAdd($data) {
        return $this->db->autoExecute($data,$this->table)?$this->db->insert_id():false;
    }

    // 返回商品数量
    public function goodsNum($cat_ids=0) {
        $sql = 'select count(*) from ' . $this->table .' where 1 ';

        if(is_array($cat_ids)) {
            $sql .= 'and cat_id in (' . implode(',',$cat_ids) . ')';
        } else if($cat_ids > 0) {
            $sql .= ' and cat_id = ' . $cat_ids;
        }

        return $this->db->getOne($sql);
    }

    // 返回所有商品信息
    public function goodsList($offset = -1,$N = 0) {
        $sql = 'select goods_id,goods_sn,goods_name,shop_price,is_on_sale,is_best,is_new,is_hot,goods_number from ' . $this->table .' order by add_time desc';

        if($offset >= 0) {
            $sql .= ' limit ' . $offset .', ' . $N;
        }

        return $this->db->getAll($sql);
    }

    // 递归生成不重复货号
    public function createSn($sn='') {
        if(!$sn) {
          $sn =  'mg' . date('ymd') . rand(1000000,9999999);
        }

        $sql = 'select count(*) from ' . $this->table . ' where goods_sn = ' . "'$sn'";
        return $this->db->getOne($sql)?$this->createSn():$sn;
    }

    // 删除相关的商品
    public function del($goods_id) {
        $this->delImg($goods_id);

        $sql = 'delete from goods where goods_id = ' . $goods_id;
        $rs = $this->db->query($sql);

        return  $rs?$this->db->affected_rows():false;
    }

    // 删除商品对应的图片
    public function delImg($goods_id) {
        $sql = 'select goods_img,thumb_img,ori_img from goods where goods_id = ' . $goods_id;
        $allum = $this->db->getRow($sql);

        if(empty($allum)) {
            return;
        }

        foreach($allum as $v) {
            if(empty($v)) {
                continue;
            }

            $pic = ROOT . '/' . $v;
            unlink($pic);
        }

    }

    // 专门用来取精品/新品/热销的方法
    public function getTop($type='best/new/hot',$n=3) {
        if($type!='best' && $type!='new' && $type!='hot') {
            return false;
        }

        $sql = 'select goods_id,goods_sn,goods_name,thumb_img,goods_img,shop_price,goods_number from ' . $this->table .' where is_' . $type . '=1 and is_on_sale = 1 order by add_time desc limit ' . $n;

        return $this->db->getAll($sql);
    }


    // 取商品详细信息的方法
    public function goodsInfo($goods_id) {
        //$sql = 'select goods_id,cat_id,goods_sn,goods_name,brand_name,thumb_img,goods_img,shop_price,market_price,goods_number,goods_desc from ' . $this->table . ' left join brand on ' . $this->table . '.brand_id = brand.brand_id where goods_id = '. $goods_id;
		$sql = 'select goods_id,cat_id,goods_sn,goods_name,thumb_img,goods_img,shop_price,market_price,goods_number,goods_desc from ' . $this->table . ' where goods_id = '. $goods_id;
        return $this->db->getRow($sql);
    }

    // 获取栏目下面商品的方法
    public function cateGoods($cat_ids,$offset=0,$n=9) {
        $sql = 'select goods_id,cat_id,goods_sn,goods_name,thumb_img,goods_img,shop_price,market_price,goods_number from ' . $this->table . ' where cat_id ';

        if(is_array($cat_ids)) {
            $sql .= ' in (' . implode(',',$cat_ids) . ')';
        } else {
            $sql .= ' = ' . $cat_ids;
        }
        $sql .= ' order by add_time desc limit ' . $offset . ',' . $n;
        // echo $sql;
        return $this->db->getAll($sql);
    }

    // 根据id查询出购物车所需信息的方法(查询字段较小)
    public function goodsCart($goods_id) {
        $sql = 'select goods_id,goods_sn,goods_name,is_delete,is_on_sale,thumb_img,shop_price,goods_number from ' . $this->table . ' where goods_id = '. $goods_id;

        return $this->db->getRow($sql);
    }
}