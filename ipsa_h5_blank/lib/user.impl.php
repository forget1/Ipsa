<?php 
function reg($user_info){
	$arr=$_POST;
	$arr['unionid']=$user_info['unionid'];
	$arr['nickname'] = $user_info['nickname'];
	$arr['headimgurl'] = $user_info['headimgurl'];
	$arr['sex'] = $user_info['sex'];;
	$arr['city'] = $user_info['city'];
	$arr['province'] = $user_info['province'];
	$arr['active'] = 1;
	$arr['role'] = 'user';
	$time = date("Y:m:d H:i:s");
	$arr['last_login'] = $time;
	$arr['login_counter'] = 1;
	$arr['created']= $time;
	$arr['modified']= $time;
	print_r($arr);
	if(insert("users", $arr)){
		$mes="注册成功!<br/>3秒钟后跳转到登陆页面!";
	}else{
		$mes="注册失败!<br/><a href='index.php'>重新注册</a>|<a href='index.php'>查看首页</a>";
	}
	return $mes;
}
function login(){
	$username=$_POST['username'];
	//addslashes():使用反斜线引用特殊字符
	//$username=addslashes($username);
	$username=mysql_escape_string($username);
	$password=md5($_POST['password']);
	$sql="select * from users where username='{$username}' and password='{$password}'";
	//$resNum=getResultNum($sql);
	$row=fetchOne($sql);
	//echo $resNum;
	if($row){
		
		$_SESSION['loginFlag']=$row['id'];
		$_SESSION['username']=$row['username'];
		$mes="登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
		update("users",$arr,"id=".$row['id']);
	}else{
		$mes="登陆失败！<a href='login.php'>重新登陆</a>";
	}
	return $mes;
}

function userOut(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}

	session_destroy();
	header("location:index.php");
}

/**
 *
 * ['openid' => 'xxxxxxxxxxx']
 * ['username' => 'xxxxxxxxxxxx']
 */
function isUserExisted($input){
	$sql= "";
	if(isset($input)){
		foreach ($input as $key => $val) {
			$sql="select * from users where $key='{$val}'";
		}
		if(getResultNum($sql) != 0){
			return true;
		}else{
			return false;
		}
	}
}


