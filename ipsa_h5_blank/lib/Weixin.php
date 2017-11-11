<?php 
/**
 * 微信公众号平台 使用接口
 *
 * version:
 * time: 2016-01-08
 */

Class Weixin {


/**
 * Name of the event
 *
 * @var string
 */
	private $_appid = null;
    private $_code = null;
	private $_appsecret = null;
	private $_accessToken = null;
	private $_ticket = null;
	private $_qrcode = null;
    private $_domain = null;
    // private $_openUrl ='http://www.shmachinist.com/weichat_open/open_auth.php&response_type=code&scope=snsapi_login&state=hahasadfsdfsdfsdfs#wechat_redirect';
	// public function __construct($appid,$appsecret) {
 //       	$this->_appid = $appid;
 //       	$this->_appsecret = $appsecret;
 //   	}
   	public function __construct($input=false) {
        if(is_array($input)){
            foreach ($input as $key => $val) {
                $this->$key = $val;
            }
        }
    }

   	// 设置QR code 信息
   	public function setQRcodeInfo($qrcode){
   		$this->_qrcode = $qrcode;
   	}

   	// 获取二维码
 //   	public function getQRCode(){
 //   		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($this->_ticket);
	// 	$QRimageInfo = image_curl_get($url);
	// 	return $QRimageInfo;
	// }

   ################################### 测试方法 #############################
   	// public function getAppid(){
   	// 	return $this->$_appid;
    // }
    public function setCode($code){
        $this->_code = $code;
    }

    public function getCode(){
        return $this->_code;
    }

   	public function getAppid() {
		return $this->_appid;
	}

	public function getAppsecret() {
		return $this->_appsecret;
	}

    public function getDomain() {
        return $this->domain;
    }

	public function getAccessTokenTest() {
		$this->getAccessToken();
		return $this->_accessToken;
	}

	public function getTicketTest() {
		$this->getAccessToken();
		$this->getTicket();
		return $this->_ticket;
	}

	public function getQRCodeTest(){
		$this->getAccessToken();
		$this->getTicket();
		$ticket = urlencode($this->_ticket);
   		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
		// echo $url;
		// $QRimageInfo = image_curl_get($url);
		return $url;
	}

    public function getOpenUrl(){
        // $url_base = 'http://www.shmachinist.com/rouges';
        $url_base = $this->getDomain();
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->_appid.'&redirect_uri='.$url_base.'/gongzhonghao_auth.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        return $url;
    }

    public function getOpenTokenAndOpenid(){
        $get_token_url = $this->getOpenTokenUrl();
        $json_obj = $this->simple_curl_get_open($get_token_url);
        // return $json_obj;
        // 根据openid和access_token查询用户信息
        $this->_accessToken = $json_obj['access_token'];
        $this->_openid = $json_obj['openid'];
    }

    public function getUserInfo(){
        $get_token_url = $this->getUserInfoUrl();
        $user_obj = $this->simple_curl_get_open($get_token_url);
        return $user_obj;
    }

   ################################### 私有方法 #############################
    //处理用户事件
    private function handleEvent($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $event = $postObj->Event;
        //扫描二维码并关注
        if($event == "subscribe"){
            $eventkey = $postObj->EventKey;
            $extradata = str_replace("qrscene_","",$eventkey);
            
            $res = $this->weixin->subscribe($extradata, $fromUsername);
            if($res){
                return $this->handleMessage($postObj, "subscribe success");
            }
        }
        //取消关注公众号
        else if($event == "unsubscribe"){
            $res = $this->weixin->unsubscribe($fromUsername);
            if($res){
                return $this->handleMessage($postObj, "unsubscribe success");
            }
        }
        //已关注用户扫描
        else if($event == "SCAN"){
            $eventkey = $postObj->EventKey;
            $extradata = $eventkey;
            
            $res = $this->weixin->subscribe($extradata, $fromUsername);
            if($res){
                return $this->handleMessage($postObj, "subscribe success");
            }
        }

        return null;
    }
	
    private function getOpenTokenUrl(){
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->_appid.'&secret='.$this->_appsecret.'&code='.$this->_code.'&grant_type=authorization_code';
        // $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->_appid.'&secret='.$this->_appsecret.'&code='.$code.'&grant_type=authorization_code';
        return $url;
    }

    private function getUserInfoUrl(){
        return 'https://api.weixin.qq.com/sns/userinfo?access_token='.$this->_accessToken.'&openid='.$this->_openid.'&lang=zh_CN';
    }

   //获取AccessToken
    private function getAccessToken()
    {
        //$token = $this->redis->get($this->_cachekey); //有调用次数限制，存在Redis缓存
        if(is_null($this->_accessToken)){
            $result = $this->simple_curl_get("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->_appid."&secret=".$this->_appsecret);
            if(array_key_exists("access_token", $result)){
                $this->_accessToken = $result["access_token"];
                $expire = $result["expires_in"];
            }
            // Redis缓存
            // if(!is_null($token)){
            //     $this->redis->setex($this->_cachekey, $expire - 1800, $token);
            // }
        }
        return $this->_accessToken;
    }

    //获取二维码ticket信息
    private function getTicket(){
    	if(is_null($this->_ticket)){
            $result = $this->simple_curl_post("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->_accessToken,$this->_qrcode);
            if(array_key_exists("ticket", $result)){
                $this->_ticket = empty($result["ticket"])? '':$result["ticket"];
            }
            // Redis缓存
            // if(!is_null($token)){
            //     $this->redis->setex($this->_cachekey, $expire - 1800, $token);
            // }
        }
        return $this->_ticket;
    }

	private function simple_curl_post($url,$postData){
		// echo $url;
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	    $output = curl_exec($ch); 
	    if (curl_errno($ch)) { 
	        return 'Errno'.curl_error($ch);
	    }
	    curl_close($ch); 
	    // echo $output;
	    $jsoninfo=json_decode($output,true);
	    return $jsoninfo;
	}

    private function simple_curl_get_open($url){
        // Session
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $output = curl_exec($ch);
        if (curl_errno($ch)) { 
            return 'Errno'.curl_error($ch);
        }
        curl_close($ch);
        $jsoninfo = json_decode($output,true);
        return $jsoninfo;
    }
    
    private function simple_curl_get($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		if (curl_errno($ch)) { 
	        return 'Errno'.curl_error($ch);
	    }
		curl_close($ch);
		$jsoninfo = json_decode($output,true);
		return $jsoninfo;
	}

	// private function image_curl_get($url){
	// 	echo $url;
	// 	$ch = curl_init($url);
	// 	curl_setopt($ch, CURLOPT_HEADER, 0);
	//     curl_setopt($ch, CURLOPT_NOBODY, 0);
	//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	//     $package = curl_exec($ch);
	//     if (curl_errno($ch)) { 
	//         return 'Errno'.curl_error($ch);
	//     }
	//     $httpInfo = curl_getinfo($ch);
	//     curl_close($ch);
	//     echo $package;
	//     echo $httpInfo;
	//     return array_merge(array('body'=>$package),array('header'=>$httpInfo));
	// }



}
