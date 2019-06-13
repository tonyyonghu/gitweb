<?php

// 数据库处理类


abstract class abs_db {
    abstract protected function connect();
    abstract protected function select_db($dbname='');
    abstract protected function setchar();
    abstract protected function query($sql);
    abstract protected function getAll($sql);
    abstract protected function getRow($sql);
    abstract protected function getOne($sql);
    abstract protected function error();
}


class mysql extends abs_db {
    private static $ins = false;
    private $conn = false;
    private $conf = false;
    

    protected function __construct() {
        $this->conf = conf::getIns();
        
        $this->connect();
        $this->select_db();
        $this->setChar();
    }


    public function __destruct() {
    }

    public static function getIns() {
        if(self::$ins === false) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    protected function connect() {
        $this->conn = mysqli_connect($this->conf->host,$this->conf->user,$this->conf->pwd,$this->conf->db);
        if(!$this->conn) {
            $err = new Exception('连接失败error');
            throw $err;
        }
    }

    protected function select_db($dbname='') {
        if($dbname == '') {
            //$sql = 'use ' . $this->conf->db;
			$sql = 'use `' . $this->conf->db . '`';
            $this->query($sql);
        }
    }

    protected function setChar() {
        $sql = 'set names ' . $this->conf->char;
        return $this->query($sql);
    }

    public function query($sql) {
        if($this->conf->debug) {
            $this->log($sql);
        }

        $rs = mysqli_query($this->conn,$sql);

        if(!$rs) {
            $this->log($this->error());
        }

        return $rs;
    }

    public function autoExecute($arr,$table,$mode='insert',$where = ' where 1 limit 1') {
        /*    insert into tbname (username,passwd,email) values ('',)
        /// 把所有的键名用','接起来
        // implode(',',array_keys($arr));
        // implode("','",array_values($arr));
        */
        
        if(!is_array($arr)) {
            return false;
        }

        if($mode == 'update') {
            $sql = 'update ' . $table .' set ';
            foreach($arr as $k=>$v) {
                $sql .= $k . "='" . $v ."',";
            }
            $sql = rtrim($sql,',');
            $sql .= $where;
            
            return $this->query($sql);
        }

        $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
        $sql .= ' values (\'';
        $sql .= implode("','",array_values($arr));
        $sql .= '\')';

        return $this->query($sql);
    
    }

    public function getAll($sql) {
        $rs = $this->query($sql);
        
        $list = array();
        while($row = mysqli_fetch_assoc($rs)) {
			//print_r($row);
            $list[] = $row;
        }
		//print_r($row = mysql_fetch_assoc($rs));
		//print_r($list);
        return $list;
    }

    public function getRow($sql) {
        $rs = $this->query($sql);
        
        return mysqli_fetch_assoc($rs);
    }

    public function getOne($sql) {
        $rs = $this->query($sql);
        $row = mysqli_fetch_row($rs);

        return $row[0];
    }

    // 返回影响行数的函数
    public function affected_rows() {
        return mysqli_affected_rows($this->conn);
    }

    // 返回最新的auto_increment列的自增长的值
    public function insert_id() {
        return mysqli_insert_id($this->conn);
    }

    public function error() {
        return mysqli_error($this->conn);
    }

    public function log($sql) {
        $log = ROOT . '/data/sql.log';
        if(!file_exists($log)) {
            $fh = fopen($log,'w');
        } else {
            if(filesize($log) > 1024 * 1024) {
                $fh = fopen($log,'w');
            } else {
                $fh = fopen($log,'a');
            }
        }

        fwrite($fh,$sql . "\r\n");
        fclose($fh);
    }

}

/*
require('./conf.class.php');

$db = mysql::getIns();
print_r($db);


$sql = 'select * from art limit 5';


print_r($db->getAll($sql));
*/


