<?php
namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller {
	//自动运行方法判断权限和是否登录
	Public function _initialize(){
	}
	/*
	/* 查询单条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @return array 查询的结果集
     */
	public function finddata($table='',$where='',$field=''){
		$fields = explode(',', $field);
		if ($fields[1] || $field=='') {
		    $data = M($table)->field($field)->where($where)->find();
		}else{
		    $data = M($table)->field($field)->where($where)->getField($fields[0]);
		}
		return $data;
	}
	/* 查询多条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @param string $order 排序
     * @return array 查询的结果集
     */
	public function selectdata($table='',$where='',$field='',$order='id DESC'){
		$data = M($table)->field($field)->order($order)->where($where)->select();
		return $data;
	}
	/* 添加单条数据
     * @param string $table 查询的表名
     * @param array $data 插入的数据
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
	public function adddata($table='',$data=''){
		if ($rs = M($table)->add($data)) {
			return $rs;
		}else{
			return false;
		}
	}
	/* 保存修改数据
     * @param string $table 查询的表名
     * @param array $data 查询的where条件，
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function savedata($table='',$data='',$where=''){
		if (M($table)->where($where)->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	/* 删除数据
     * @param string $table 查询的表名
     * @param array $data 查询的where条件，
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function deletedata($table='',$where=''){
		if(M($table)->where($where)->delete()) {
			return true;
		}else{
			return false;
		}
	}
	//单图上传
	public function upload_one($img){
           $upload = new \Think\Upload();// 实例化上传类
           $upload->maxSize   = 3145728 ;// 设置附件上传大小
           $upload->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
           $upload->rootPath  = './'; // 设置附件上传目录
           $upload->savePath  = '/Uploads/'; // 设置附件上传目录
           // 上传文件
           $info   =   $upload->uploadOne($img);
           if(!$info) {// 上传错误提示错误信息
               return json_encode(array('status' => 'error','msg' => $upload->getError()));
               exit;
           }else{// 上传成功          
               $imgpath = 'https://'.$_SERVER['HTTP_HOST'].$info['savepath'].$info['savename'];
               return json_encode(array('status' => 'success','url'=>$imgpath));
               exit;
           } 
	}
	/* 上传图片
     * @param string $path 上传的路径，于/Uploads/Admin/".$path."/"下
     * @return array 上传的状态
     */
	public function uploadsImg(){
		$members_id = I('get.members_id','','intval');
		$path = "refund";
		$typeArr = array("jpg", "png", "gif", "jpeg", "mov", "gears", "html5", "html4", "silverlight", "flash"); 
		$path = "Uploads/Index/".$path."/"; //上传路径
		if (isset($_POST)) {
		    $name = $_FILES['file']['name'];
		    $size = $_FILES['file']['size'];
		    $name_tmp = $_FILES['file']['tmp_name'];
		    if (empty($name)) {
		        echo encode(array("error" => "您还未选择文件",'code'=>1));
		        exit;
		    }
		    $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型
		    if (!in_array($type, $typeArr)){
		        echo encode(array("error" => "清上传指定类型的文件！","type"=>"types",'code'=>2));
		        exit;
		    }
		    if ($size > (50000 * 1024)) { //上传大小
		        echo encode(array("error" => "文件大小已超过50000KB！","type"=>"size",'code'=>3));
		        exit;
		    }
		    $pic_name = time() . rand(10000, 99999) . "." . $type; //文件名称
		    $pic_url = $path . $pic_name; //上传后图片路径+名称
		    if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
		    	$picpath =  __ROOT__.'/'.$pic_url;
		    	if (S($members_id)) {
		    		$tmpPicArr =  S($members_id);
		    		$tmpPicArr[] = $picpath;
		    		S($members_id,$tmpPicArr,20);
		    	}else{
		    		$picArr = $picpath;
		    		S($members_id,array($picArr),20);
		    	}
		        echo encode(array("error" =>0, "pic" =>$picpath, "name" => $pic_name,'code'=>6));

		    } else {
		        echo encode(array("error" => "上传有误，请检查服务器配置！","type"=>"config",'code'=>4));
		    }
		}
	}
	//获取access_token并全局缓存
	public function get_session($data){
		$key = $data['key'];
		$code = $data['code'];
		$session = S($key);
		if($session) {    // 已缓存，直接使用
			$sdata = S($key);
			$returndata = json_encode(array('openid'=>$sdata['openid'],'key'=>$key));
		} else {    // 获取access_token
			$config = $this->finddata('base',array('id'=>1));
			$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$config['appid'].'&secret='.$config['appsecret'].'&js_code='.$code.'&grant_type=authorization_code';
			$json = $this->curls($url);
			$result = json_decode($json,1);
			S('new',$result,7200);
			$newkey = randomCode(2,6);
			S($newkey,$result,7200);
			$returndata = json_encode(array('openid'=>$result['openid'],'key'=>$newkey));
		}
		return $returndata;
	}
	//获取微信信息
	public function curls($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch); // 已经获取到内容，没有输出到页面上。
		curl_close($ch);
		return $data;
    }
	//短信发送$mobile:发送手机号 $totalnum:充值额度 $surplusnum：剩余额度
    public function SendMsg($members_id,$phone){
        header('Content-type: text/html; charset=utf-8');
        $base = M('base')->field('msg_account,msg_secret,msg_url,msg_sign')->find();
        $password = md5($base['msg_account'].md5($base['msg_secret']));
        $rand =  rand(100000,900000);
        $msgcode = array("msgcode"=>$rand,'userphone'=>$phone);
		S($members_id,$msgcode,3600);
        $content = "尊敬的用户您好，您的验证码为：".$rand."，5分钟有效【".$base['msg_sign']."】";
        $data = "username=".$base['msg_account']."&password=".$password."&mobile=".$phone."&content=".$content;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $base['msg_url']);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
	
	/* 以下为微信支付所需要的 */
	private function formatBizQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
			if($urlencode){
				$v = urlencode($v);
			}
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0){
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	//作用：生成签名
	private function getSign($Obj,$key){
		foreach ($Obj as $k => $v){
			$Parameters[$k] = $v;
		}
		// 签名步骤一：按字典序排序参数
		ksort($Parameters);
		$String = $this->formatBizQueryParaMap($Parameters, false);
		// 签名步骤二：在string后加入KEY
		$String = $String."&key=".$key;

		// 签名步骤三：MD5加密
		$String = md5($String);
		// 签名步骤四：所有字符转为大写
		$result = strtoupper($String);
		return $result;
	}
	//数组转XML格式
	public function arrayToXml($arr){ 
		$xml = "<xml>"; 
		foreach ($arr as $key=>$val){ 
			if(is_array($val)){ 
				$xml.="<".$key.">".$this->arrayToXml($val)."</".$key.">"; 
			}else{ 
				$xml.="<".$key.">".$val."</".$key.">"; 
			} 
		} 
		$xml.="</xml>"; 
		return $xml; 
	}
	//curl post数据返回json
    public function curlPostXml($url, $xmldata){
    	$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		curl_close($curl);
		//关闭cURL资源，并且释放系统资源
		//禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		//先把xml转换为simplexml对象，再把simplexml对象转换成 json，再将 json 转换成数组。
		$value_array = json_decode(json_encode(simplexml_load_string($tmpInfo, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $value_array;
	}
	public function wxpay($body,$ordercode,$money,$openid){
		 // dump($ordercode);
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$base = $this->finddata('base',array('id'=>1));
		if (strpos($_SERVER['REQUEST_URI'],"index.php")) {
			$backurl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/index.php/Api/Callback/smpayback";
		}else{
			$backurl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/Api/Callback/smpayback";
		}
		// 接口所需参数(数组形式)
		$parameter = array(
			'appid' 			=>$base['sm_appid'],//小程序ID
			'mch_id'			=>$base['mchid'],//商户号
			'nonce_str'			=>randomCode(),//随机字符串
			'body'				=>$body,//商品描述
			'out_trade_no'		=>$ordercode,//商户订单号
			// 'total_fee'			=>1,//总金额
			'total_fee'			=>$money*100,//总金额
			'spbill_create_ip'	=>$_SERVER['REMOTE_ADDR'],//终端IP
			'notify_url'		=>$backurl,//通知地址
			'trade_type'		=>'JSAPI',//交易类型
			'openid'			=>$openid //用户标识
		);
		
		$parameter['sign'] = $this->getSign($parameter,$base['key']);
		//接口所需参数(数组转XML格式)
		$xmldata = $this->arrayToXml($parameter);
		//初始一个curl会话
		$return = $this->curlPostXml($url,$xmldata);
		if($return['result_code'] != 'SUCCESS'){
			echo json_encode($return); exit;
		}
		//生成小程序支付签名所需参数
		$parameters=array(
			  'appId'		=>$base['sm_appid'],//小程序ID
			  'timeStamp'	=>''.time().'',//时间戳
			  'nonceStr'	=>randomCode(),//随机串
			  'package'		=>'prepay_id='.$return['prepay_id'],//数据包
			  'signType'	=>'MD5'//签名方式
		 );
		$parameters['paySign'] = $this->getSign($parameters,$base['key']);
		return $parameters;
	}


    // 获取公共配置项
    public function getConfig(){
    	$request = json_decode(file_get_contents('php://input'),1);
    	$field = $request['field'];
    	$fields = explode(',', $field);
		if ($fields[1] || $field=='') {
		    $data = M("base")->field($field)->where(array('id'=>1))->find();
		}else{
		    $data = M("base")->field($field)->where(array('id'=>1))->getField($fields[0]);
		    switch ($fields[0]){
				case 'help':
					$data = str_replace('<img src="/Uploads/Ueditor/','<img style="width:100%;" src="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].'/Uploads/Ueditor/',$data);
					break;
			}
		}
		if ($data){
        	echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
        	echo encode(array('code'=>2,'msg'=>'没有获取到对应的属性值'));
        }
    }
    /* 统计数据
     * @param string $table 数据表名
     * @param array $data 查询的where条件，
     * @return data 数量
     */
    public function countdata($table='',$where='',$field=null){
        $data = M($table)->where($where)->count($field);
        return $data;
    }

    public function addFormId($formid,$members_id){
    	$formArr = array(
            "create_time"=>time(),
            'status'=>0,
            'formid'=>$formid,
            "members_id"=>$members_id
        );
        $rs = $this->adddata('formid',$formArr);
        return $rs;
    }


	/**
	 * 收藏的视频
	 */
	public function collect_video($where = []){
		if (empty($where)) {
			echo json_encode(['status' => '0', 'msg' => '缺少参数']);
		}
		$res = M('collect')->where($where)->select();
		return $res ? $res : false;
	}






    
}