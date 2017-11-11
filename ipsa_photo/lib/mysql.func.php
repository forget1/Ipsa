<?php 
/**
 * 连接数据库
 * @return resource
 */
function connect(){
	$link=mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}
//SQL: Select 
//Select $attr from $table where $where
//Select $attr from $table where 1
function selectOne($table,$where){
	if($where!=null){
		$query =  "select * from ".$table." WHERE ".$where;
	}
	else{
		$query =  "select * from ".$table." WHERE 1";
	}
	// echo $query;
	$exc = mysql_query($query);
	
	while($result = mysql_fetch_array($exc)){
		$r = $result;
	}
	return $r;
}

function selectMax($table) {
	$query = "SELECT * FROM ".$table." WHERE id = ( SELECT max(id) FROM ".$table." WHERE 1) ";
	$exc = mysql_query($query);
	// echo $query;
	while($result = mysql_fetch_array($exc)){
		$r = $result;
	}
	return $r;
}

//SQL: Select 
//Select $attr from $table where $where
//Select $attr from $table where 1
function select($table,$where){
	if($where!=null){
		$query =  "select * from ".$table." WHERE ".$where;
	}
	else{
		$query =  "select * from ".$table." WHERE 1";
	}
	// echo $query;
	$exc = mysql_query($query);
	$r = array();
	while($result = mysql_fetch_array($exc)){
		array_push($r,$result);
		//echo $result['dianping_id'];
	}
	// echo json_encode($r);
	return $r;
}

function selectParts($part,$table,$where){
	if($where!=null){
		$query =  "select ".$part." from ".$table." WHERE ".$where;
	}
	else{
		$query =  "select ".$part." from ".$table." WHERE 1";
	}
	//echo $query;
	$exc = mysql_query($query);
	$r = array();
	while($result = mysql_fetch_array($exc)){
		array_push($r,$result);
		//echo $result['dianping_id'];
	}
	//echo json_encode($r);
	return $r;
}


//SQL: insert
//insert into $table ($array_keys) value ($array_values)
function insert($table,$array){
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	$query="insert into {$table} ($keys) values ({$vals})";
	$exc = mysql_query($query);
	// echo $query;
	return mysql_insert_id();
}

//SQL: update
//update $table set($array_keys)=($array_values) where $where
function update($table,$array,$where=null){
	$str=null;
	foreach($array as $key=>$val){
		if($str==null){
			$sep="";
		}else{
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
	$query="update {$table} set {$str} ".($where==null?null:" where ".$where);
	// echo $query;
	$result=mysql_query($query);
	if($result){
		//echo mysql_affected_rows();
		return mysql_affected_rows();
	}else{
		return false;
	}
}

//SQL:where
//delete from $table where $where
function delete($table,$where=null){
	$where=$where==null?null:" where ".$where;
	$query="delete from {$table} {$where}";
	mysql_query($query);
	//echo mysql_affected_rows();
	//return mysql_affected_rows();
}

//Pass in customized Query in $query
function SQL($query){
	$exc = mysql_query($query);
	$r = array();
	if(split(" ",$query)[0]=='select'){
		while($result = mysql_fetch_row($exc)){
			array_push($r,$result);
		}
		echo json_encode($r) ;
		return $r;
	}else{
		echo mysql_affected_rows();
		return mysql_affected_rows();
	}
}

// 获取上一步插入的id
function getInsertId(){
	return mysql_insert_id();
}
?>