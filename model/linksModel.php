<?php
defined('ACC')||exit('Access denied');

class linksModel extends Model {
    protected $table = 'links';

    // 发布友链的model方法,返回刚发布的友链id,或者false
    public function linksAdd($data) {
        return $this->db->autoExecute($data,$this->table)?$this->db->insert_id():false;
    }

    // 返回友链数量
    public function linksNum() {
        $sql = 'select count(*) from ' . $this->table .' where 1 ';

        return $this->db->getOne($sql);
    }

    // 返回所有友链信息
    public function linksList($offset = -1,$N = 0) {
        $sql = 'select id,linkname,linkurl from ' . $this->table .' order by add_time desc';
        if($offset >= 0) {
            $sql .= ' limit ' . $offset .', ' . $N;
        }
        return $this->db->getAll($sql);
    }
    // 删除相关的友链
    public function del($id) {
        //$this->delImg($goods_id);

        $sql = 'delete from links where id = ' . $id;
        $rs = $this->db->query($sql);

        return  $rs?$this->db->affected_rows():false;
    }
	// 更新相应的友链
	public function update($id,$data)
	{
		
		$sql='update '.$this->table.' set linkname='."'".$data['linkname']."'".' , linkurl='."'".$data['linkurl']."'".' where id='.$id;
		$rs = $this->db->query($sql);

        return  $rs?$this->db->affected_rows():false;
	}

    // 取友链详细信息的方法
    public function linksInfo($id) {
        //$sql = 'select goods_id,cat_id,goods_sn,goods_name,brand_name,thumb_img,goods_img,shop_price,market_price,goods_number,goods_desc from ' . $this->table . ' left join brand on ' . $this->table . '.brand_id = brand.brand_id where goods_id = '. $goods_id;
		$sql = 'select id,linkname,linkurl from ' . $this->table . ' where id = '. $id;
        return $this->db->getRow($sql);
    }
}