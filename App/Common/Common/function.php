<?php
    // 截取函数
    function subtext($text, $length){
        if(mb_strlen($text, 'utf8') > $length){
            return mb_substr($text, 0, $length, 'utf8').'...';
        }else{
	        return $text;
        }
    }
    // 去掉字符串最后一个汉字
    function subEndText($text, $length){
    	$textLength = mb_strlen($text, 'utf8');
    	return mb_substr($text, 0, $textLength-1, 'utf8');
    }
    function getGb2312($file) {
	    return iconv('UTF-8', 'GB2312', $file);
	}
    function bykeyarr($arr,$key){
	    if(!array_key_exists($key, $arr)){  
	        return $arr;  
	    }
	    $keys = array_keys($arr);  
	    $index = array_search($key, $keys);  
	    if($index !== FALSE){  
	        array_splice($arr, $index, 1);  
	    }  
	    return $arr;
	}
	function download($filepath,$filename){ 
     if ((isset($filepath))&&(file_exists($filepath))){ 
         header("Content-length: ".filesize($filepath)); 
         header('Content-Type: application/octet-stream'); 
         header('Content-Disposition: attachment; filename="' . $filename . '"'); 
         readfile("$filepath"); 
      } else { 
         echo "Looks like file does not exist!"; 
      } 
    }
    /**
	 * 无限极分类
	 * @param  [type] $data [description]
	 * @param  string $pid  [description]
	 * @return [type]       [description]
	 */
	function category($data,$pid='0'){
	    $arr = array();
	    foreach($data as $v){
	        if($v['pid'] == $pid){
	            $v['child'] = category($data,$v['id']);
	            $arr[] = $v;    
	        }
	    }
	    return $arr;
	}
	// 下载网络图片
	function downimg($url, $filename = "") {
		if ($url == "") {
		    return false;
		}
		if ($filename == "") {
		   $ext = strrchr ( $url, "." );
			if ($ext != ".gif" && $ext != ".jpg" && $ext != ".png") {
			   return false;
			}
			$filename = time () . $ext;
		}
		//文件 保存路径
		ob_start ();
		readfile ( $url );
		$img = ob_get_contents ();
		ob_end_clean ();
		$size = strlen ( $img );
		//文件大小
		$fp2 = @fopen ( $filename, "a" );
		fwrite ( $fp2, $img );
		fclose ( $fp2 );
		return $filename;
	}
	/**
	 * 无限极分类
	 * @param  [type]  $cate  [description]
	 * @param  integer $pid   [description]
	 * @param  integer $level [description]
	 * @param  string  $html  [description]
	 * @return [type]         [description]
	 */
	function sortOut($cate,$pid=0,$level=0,$html='--'){
	    $tree = array();
	    foreach($cate as $v){
	        if($v['pid'] == $pid){
	            $v['level'] = $level + 1;
	            $v['html'] = str_repeat($html, $level);
	            $tree[] = $v;
	            $tree = array_merge($tree, sortOut($cate,$v['id'],$level+1,$html));
	        }
	    }
	    return $tree;
	}
    //无限极分类函数
	function node_merge ($node,$access=null,$pid=0){
		$arr=array();
		foreach ($node as $v) {
			if(is_array($access)){
				$v['access'] = in_array($v['id'], $access) ? 1 : 0;
			}
			if($v['pid']==$pid){
				$v['child']=node_merge($node,$access,$v['id']);
				$arr[]=$v;
			}
		}
		return $arr;
	}

	/**
	 * 生成随机数
	 * @param  [type]  $type  [类型，1：订单号，2随机数]
	 * @param  integer $num   [数量]
	 * @return [type]         [字符串]
	 */
	function randomCode($type=1,$num=8){
		if ($type==1) {
			$str = "1234567890";//输出字符集
			$len = strlen($str)-1;
			for($i=0 ; $i<20; $i++){
				$s.= $str[rand(0,$len)];
			}
			$str = date('YmdHis').substr($s,5,$num) ;
		}else{
			$str = "123456789qwertyuiopasdfghjklzxcvbnm";//输出字符集
			$len = strlen($str)-1;
			for($i=0 ; $i<30; $i++){
				$s.= $str[rand(0,$len)];
			}
			$str = str_shuffle(date('YmdHis').$s);
			$str = substr($str,5,$num);
		}
		return $str;
	}

	function getIpApi($ip){
		$ch = curl_init();
	    $url = 'http://apis.baidu.com/showapi_open_bus/ip/ip?ip='.$ip;
	    $header = array(
	        'apikey: 549cd9ecae763b1eee9fc18d153d8e66',
	    );
	    // 添加apikey到header
	    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    // 执行HTTP请求
	    curl_setopt($ch , CURLOPT_URL , $url);
	    $res = curl_exec($ch);
	    curl_close($ch);
	    $res = json_decode($res,1);
	    return $res['showapi_res_body']['region'].$res['showapi_res_body']['city'].$res['showapi_res_body']['isp'].'机房';
	}
	// 删除文件和文件架函数
	function deleteDir($dir){
	   $handle = @opendir($dir);
	   readdir($handle);
	   readdir($handle);
	   while(false !== ($file = readdir($handle))){
		    $file = $dir.DIRECTORY_SEPARATOR.$file;
		    if(is_dir($file)){
		        deleteDir($file);             //如果是子目录就进行递归操作
		    }else{                          //如果是文件，用unlink()删除
		         @unlink($file);
		    }
	    }
	    closedir($handle);
	}
	/* 获取数据库单个配置值 */
	function getBase($fiels){
		$fiels = M('base')->where(array('id'=>1))->getField($fiels);
		return $fiels ? $fiels : "0";
	}
	function getChildsId($cate, $pid){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid']==$pid) {
				$arr[]=$v['id']; 
				$arr=array_merge($arr,getChildsId($cate,$v['id']));
			}
		}
		return $arr;
	}
	/* 获取一级分类下面商品 */
	function getIdStr($data,$id){
		$idArr = getChildsId($data,$id);
		$idArr[] = $id;
		$idStr = implode(',',$idArr);
		return $idStr;
	}
	function Api_Request($url,$data,$method="GET"){ 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch, CURLOPT_URL, $url); 
       //以下两行，忽略 https 证书 
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE); 
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE); 
        $method = strtoupper($method); 
        if ($method == "POST"){
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST"); 
            curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json")); 
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data); 
        } 
        $content = curl_exec($ch);
        curl_close($ch); 
        return $content; 
    }
    // 修改优惠券信息
	function coupon(){
		$where['status']  = 0;
		$where['end_time'] = array('lt',time());
		M('get_coupon')->where($where)->setField('status',2);
	}

	//将超时的订单状态改为拼团失败
	function groupStatus(){
		$where = "status=0 or status=1";
		$data = M("group_order")->where($where)->select();
		$wechat = A('Index/WechatApi');
		foreach ($data as $k => $v) {
			$pool = $v["over_time"] - time();
			if ($pool<0) {
				$group_order_buy = M('group_order_buy')->where(array("ordercode"=>$v["ordercode"]))->select();
				foreach ($group_order_buy as $key => $value) {
					$res = $wechat->weixinRefund($value['sub_ordercode'],$value['paymoney']);
					if ($res['result_code']=='SUCCESS') {
						M("group_order_buy")->where(array("sub_ordercode"=>$value["sub_ordercode"]))->setField("status",6);
					}
				}
				M("group_order")->where(array("id"=>$v["id"]))->setField("status",6);
			}
		}
	}
	
	function api_notice_increment($url, $data){
	    $ch = curl_init();
	    $header = "Accept-Charset: utf-8";
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $tmpInfo = curl_exec($ch);
	       //  var_dump($tmpInfo);
	       // exit;
	    if (curl_errno($ch)) {
	      return false;
	    }else{
	      // var_dump($tmpInfo);
	      return $tmpInfo;
	    }
	 }
	 function countdown($end_famate_time){
	 	date_default_timezone_set('PRC');
		$now_time = time();
		if($end_famate_time < $now_time){
		   return false;
		}
		$remain_time = $end_famate_time-$now_time; //剩余的秒数
		$remain_hour = floor($remain_time/(60*60)); //剩余的小时
		$remain_minute = floor(($remain_time - $remain_hour*60*60)/60); //剩余的分钟数
		$remain_second = ($remain_time - $remain_hour*60*60 - $remain_minute*60); //剩余的秒数
		return $remain_hour.":".$remain_minute.":".$remain_second;
	 }
	 // function rushGoods() {
	 // 	$data = M("rush_goods")->field('id,start_time,end_time')->select();
	 // 	foreach ($data as $k => $v) {
	 // 		$is_end = $v['end_time']-time();
	 // 		$is_start = $v['start_time']-time();
	 // 		if ($is_end<=0) {
	 // 			M('rush_goods')->where(array('id'=>$v['id']))->setField('status',2);
	 // 		}
	 // 		if ($is_start>=0) {
	 // 			M('rush_goods')->where(array('id'=>$v['id']))->setField('status',1);
	 // 		}
	 // 	}
	 // }
	 // 修改未支付订单有效期后的状态
	 function nopayValid(){
	 	$nopay_valid_time = getBase('nopay_valid_time');
	 	$data = M('mall_order')->where(array('status'=>0))->select();
	 	foreach ($data as $k => $v) {
	 		$end_time = $v['create_time']+ ($nopay_valid_time*60*60);
	 		$new_time = time();
	 		if ($new_time > $end_time) {
	 			M('mall_order')->where(array('id'=>$v['id']))->setField('status',5);
	 		}
	 	}
	 }
	 
	// 删除过期的formid
	 function deleteFormID(){
	 	$nowtime = time();
	 	$where = "(create_time+518400)<".$nowtime;
	 	M('formid')->where($where)->delete();
	 }

	 //输入两个时间戳返回时间差 
	function differenceTime($start_time,$end_time){
		$timediff = $end_time-$start_time;
		if ($timediff<0) {
			return "已关闭";
		}
		//计算小时数
		$remain = $timediff%86400;
		$hours = intval($remain/3600);
		//计算分钟数
		$remain = $remain%3600;
		$mins = intval($remain/60);
		return $hours."小时".$mins."分钟";
	} 
	




/**
 * 根据坐标获取地址信息  腾讯地图
 * @param  string $longitude 经度
 * @param  string $latitude  纬度
 */
function getAddrByTencent($longitude = '', $latitude = ''){
	$url = 'https://apis.map.qq.com/ws/geocoder/v1/?location=' .$latitude .',' .$longitude .'&key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
    $result = http_request($url, 'get');
    $result = json_decode($result, true);
    return $result;
}

/**
 * 根据地址获取坐标信息 腾讯地图
 * $addr 地址
 */
function getLnglatByAddr($addr = ''){
	$url = 'https://apis.map.qq.com/ws/geocoder/v1/?address=' .$addr .'&key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
    $result = http_request($url, 'get');
    $result = json_decode($result, true);
    return $result;
}

/**
 * 获取全部行政区域 腾讯地图
 */
function getAddressByTencent(){
	$url    = 'https://apis.map.qq.com/ws/district/v1/list?key=' .'FNZBZ-RDHWS-TYSOP-6GTGS-RTYYH-GNFUG';
    $result = http_request($url, 'get');
    $result = json_decode($result, true);
	return $result;
	
}


/**
 * CURL请求
 * @param $url 请求url地址
 * @param $method 请求方法 get post
 * @param null $postfields post数据数组
 * @param array $headers 请求header信息
 * @param bool|false $debug 调试开启 默认false
 * @return mixed
 */
function http_request($url, $method, $postfields = null, $headers = array(), $debug = false){
    $method = strtoupper($method);
    $ci = curl_init();
    /* Curl settings */
    curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ci, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0");
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
    curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    switch ($method) {
        case "POST":
            curl_setopt($ci, CURLOPT_POST, true);
            if (!empty($postfields)) {
                $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
                curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
            }
            break;
        default:
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
            break;
    }
    $ssl = preg_match('/^https:\/\//i', $url) ? TRUE : FALSE;
    curl_setopt($ci, CURLOPT_URL, $url);
    if ($ssl) {
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, FALSE); // 不从证书中检查SSL加密算法是否存在
    }
    //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
    curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ci, CURLOPT_MAXREDIRS, 2);/*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
    curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ci, CURLINFO_HEADER_OUT, true);
    /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
    $response = curl_exec($ci);
    $requestinfo = curl_getinfo($ci);
    $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
    if ($debug) {
        echo "=====post data======\r\n";
        var_dump($postfields);
        echo "=====info===== \r\n";
        print_r($requestinfo);
        echo "=====response=====\r\n";
        print_r($response);
    }
    curl_close($ci);
    return $response;
    //return array($http_code, $response,$requestinfo);
}








?>