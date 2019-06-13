<?php
header("Content-type: text/html; charset=utf-8");
define('ACC',true);
include('../includes/init.php');






$act = $_GET['act'];

if($act == 'pic'){
	echo 'add img floder first';
	//exit;
	echo 'pic<br />';
	
	$img_path = 'data/images/20140416';
	if($handle = opendir('../'.$img_path)){
		echo 'Directory handel:' . $handle .'<br />';
		echo 'files:<br />';
		
		$pic = array();
		while(false !== ($file = readdir($handle))){
			echo $file . '<br />';
			if(!($file == '.' || $file == '..')){
				$pic[] = $img_path.'/'.$file;
			}
			
		}
		//print_r($pic);
		//$sql = "insert into pic (`img`) values ('".$pic[7]."')";
		//echo $sql;
		
		$picdb = new picModel();
		//var_dump($pic);
		
		//exit;

		foreach($pic as $k=>$v){
			//echo $k.'--'.$v.'<br />';
			//$sql = "insert into pic (`img`) values ('".$v."')";
			//echo $sql;
			//$picdb->getPic2($v);
			//exit;
			/*if(!($picdb->getPic2($v))){
				$picdb->addPic($v);
			}*/
			$picdb->addPic($v);
			//echo $sql;
			//echo $k.'--ok';
		}
			
		//exit;
		
	}
	
}else if($act == 'keywords'){
	echo 'keywords insert <br />';
	echo 'add keywords txt first';
	//exit;
	$keywords_path = '../data/keywords/20140416/bocai-xiamen_36.txt';
	$file_name= $keywords_path;
	$fp=fopen($file_name,'r');
	$space = array("\r\n", "\n", "\r");   
	$x=0;
	$y = 0;
	//var_dump($fp);
	
	while(!feof($fp)){
		$buffer=fgets($fp,4096);
		$buffer=str_replace("'","\'",$buffer);
		$buffer=str_replace($space,'',$buffer);
		

		$keyword = $buffer ;
		if(trim($keyword)==''){continue;} //自动跳过空行
		//print_r($tkey);
		//exit;	
		
		//$sql = "INSERT ignore  INTO `tkeys` (`tkey`) VALUES ('$tkey');";
		//$db->query($sql);
		$keydb = new keywordsModel();
		//$keydb->keywordOne($keyword);
		if($keydb->keywordOne($keyword)){
			echo $x++.':'.$keyword . '<font color="red">-----------> 数据库中已存在!</font><br>';
		}else{
			//sleep(3);
			$insert_id = $keydb->keywordAdd($keyword);
			if($insert_id){
				echo $y++.':'.$keyword . '<font color="green">-----------> OK!--insert_id:'.$insert_id.'</font><br>';
			}
			//$y++;
			//$insert_id = $keydb->insert_id();
			
		}
		
		
	}
	$z = $x+$y;
	echo "<H1><font color='red'>已经完成！总数:(".$z.")</font><font color='green'>成功:(".$y.")</font></H1>";
	//$db -> close();
}else{
	echo 'tools';
}
//exit;

/*
select keyword from keywords where keyword='a圾片在线观看'
select keyword from keywords where keyword='美国唐人社'

if ($handle = opendir('/path/to/files')) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    
    while (false !== ($file = readdir($handle))) {
        echo "$file\n";
    }

    
    while ($file = readdir($handle)) {
        echo "$file\n";
    }

    closedir($handle);
}




function random_img($num){
    $rt = $arr = $img_array = array();
    if (is_dir(IMG_PATH)) {
        $h = @opendir(IMG_PATH);
        while (false !== ($f=readdir($h))){
            if ($f !='.' && $f !='..' ){
                $ext = file_ext($f);
                if(in_array($ext,array('jpg','gif','png','jpeg'))){
                    $img_array[] = $f;
                }
            }
        }

        //var_export($img_array);
        if ($img_array) {
			if($num ==1){
				return array('<img src="'.IMG_URL.$img_array[array_rand($img_array)].'">');
			}
            $arr = array_rand($img_array,$num);
            foreach ($arr as  $v){
                $rt[] = '<img src="'.IMG_URL.$img_array[$v].'">';
            }
        }
    }
    return $rt;
}
*/



