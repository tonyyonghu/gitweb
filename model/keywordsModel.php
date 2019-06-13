<?php
defined('ACC')||exit('Access denied');


class keywordsModel extends Model{
	protected $table = 'keywords';
	
	//获取关键词总数量
	public function keywordsNum(){
		$sql = 'SELECT COUNT(*) FROM ' . $this->table . ' WHERE `flag`=1';
		//echo $sql;
		return $this->db->getOne($sql);
	}
	
	//获取所有关键词信息
	public function keywordsAll($offset=0,$n=9){
		$sql = 'select id,keyword from ' . $this->table . ' where flag=1';
		$sql .= ' order by id desc limit ' . $offset . ',' . $n;
		//echo $sql;
		return $this->db->getAll($sql);
	}
	
	//取得like的多个词
	public function getMoreKeywords($str)
	{
		$sql = 'select id,keyword from ' . $this->table . ' where keyword like "'.$str.'%"';
		return $this->db->getAll($sql);
	}
	//取得一个keyword
	public function keywordsInfo($id){
		$sql = 'select id,keyword from ' . $this->table . ' where id=' . $id . ' and flag=1';
		//echo $sql;
		return $this->db->getRow($sql);
	}
	
	//随机取$num个keyword
	public function keywordsInfos($num){
	//select id ,keyword from keywords where id>=((select max(id) from keywords)-(select min(id) from keywords))*rand()+(select min(id) from keywords) limit 10;
		//$sql = 'select id,keyword from ' . $this->table . ' where flag=1  order by rand() limit '.$num;
		$sql = 'select id,keyword from ' . $this->table . ' where id>=((select max(id) from '.$this->table.')-(select min(id) from '.$this->table.'))*rand()+(select min(id) from '.$this->table.') and flag=1 limit '.$num;
		//echo $sql;
		return $this->db->getAll($sql);
	}
	
	//给定一个keyword 判断是否有此keyword
	public function keywordOne($keyword){
		$sql = "select keyword from " . $this->table . " where keyword='" . $keyword ."'";
		//echo $sql;
		return $this->db->getOne($sql);
	}
	
	//增加一个keywords
	public function keywordAdd($keyword){
		$sql = "insert into ". $this->table ." (keyword) values ('".$keyword."')";
		//echo $sql;
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	// 更新相应的关键词
	public function update($id,$data)
	{
		
		$sql='update '.$this->table.' set keyword='."'".$data['keyword']."'".' where id='.$id;
		$rs = $this->db->query($sql);

        return  $rs?$this->db->affected_rows():false;
	}
	
	
}











?>