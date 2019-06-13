<?php
defined('ACC')||exit('Access denied');

class picModel extends Model{
	protected $table = 'pic';
	
	//取得一张图片的路径
	public function getPic($id){
		//$sql = 'select img from ' . $this->table . ' where pid=' . $id .' limit ' . $id . ',2';
		$sql = 'select img from ' . $this->table . ' limit ' . $id . ',2';
		//echo $sql;
		return $this->db->getAll($sql);
		
	}
	
	//随机取得num张图片的路径
	public function getPics($pid,$num){
		$sql = "select img from " . $this->table . " limit " .$pid.",".$num;
		//echo $sql;
		return $this->db->getAll($sql);
	}
	
	//获取图片总张数
	public function picCount(){
		$sql = 'select count(*) as count from '.$this->table;
		//echo $sql;
		return $this->db->getOne($sql);
		 //return $count;
	}
	
	
	//批量插入pic
	public function addPic($img){
		
		$sql = "insert into pic (`img`) values ('".$img."')";
		echo $sql . '<br />';
		//echo $img. '--ok <br />';
		$this->db->query($sql);
		$insert_id = $this->db->insert_id();
		echo $insert_id . '-->ok <br />';
		
	}
	
}