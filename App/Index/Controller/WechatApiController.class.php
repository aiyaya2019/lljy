<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class WechatApiController extends Controller {
	public $members;
    public $appid;
    public $appsecret;
    public function __construct(){
    	parent::__construct();
		$this->members = M('members');
        $base = M('base')->where(array('id'=>1))->find();
        $this->appid = $base['appid'];
        $this->appsecret = $base['appsecret'];
        if ($top_id = I('get.top_id')) {
        	S('top_id',$top_id,5);
        }
    }
	//获取微信信息
	public function curls($url){
		$ch = curl_init(); //初始化一个cURL会话
		curl_setopt($ch, CURLOPT_URL, $url); //curl_setopt函数设置一个cURL传输选项
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch); // 已经获取到内容，没有输出到页面上。
		//关闭cURL资源，并且释放系统资源
		curl_close($ch);
		return $data;
    }
    //curl post数据返回json
    public function curlPost($url, $data,$showError=1){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno = curl_errno($ch);
		if ($errorno){
			return array('rt'=>false,'errorno'=>$errorno);
		}else{
			$js=json_decode($tmpInfo,1);
			if (intval($js['errcode']==0)){
				return array('rt'=>true,'errorno'=>0,'media_id'=>$js['media_id'],'msg_id'=>$js['msg_id']);
			}else {
				if ($showError){
					return array('rt'=>true,'errorno'=>10,'msg'=>'发生了Post错误：错误代码'.$js['errcode'].',微信返回错误信息：'.$js['errmsg']);
				}
			}
		}
	}
	 //微信分享
    public function wechat_share($url,$img,$title,$desc){
    	$nonceStr = $this->get_nonceStr();
    	$jsapi_ticket = $this->get_jsapi_ticket();
    	$timestamp = mktime();
    	$sign = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	$signature=sha1($sign);
    	$sharedata['appid'] = $this->appid;
    	$sharedata['nonceStr'] = $nonceStr;
    	$sharedata['timestamp'] = $timestamp;
    	$sharedata['signature'] = $signature;
    	$sharedata['thisurl'] = $url;
    	$sharedata['img'] = $img;
    	$sharedata['title'] = $title;
    	$sharedata['desc'] = $desc;
    	return $sharedata;
    }
	// 页面授权登录
	public function get_wechat_info(){
        $appid = $this->appid;
        $appsecret = $this->appsecret;
        if(!isset($_SESSION['wechat']['openid']) ||  $_SESSION['wechat']['openid']== ''){
	      	if($_GET['code']){
		        //通过code获取用户access_token和openid
		        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$_GET['code']."&grant_type=authorization_code";
		        $array = json_decode($this->curls($url),true);
			    if($array['openid']) {
			        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$array['access_token']."&openid=".$array['openid']."&lang=zh_CN";
			        $wxdata = json_decode($this->curls($url),true);
			        $wxdata['nickname'] = base64_encode($wxdata['nickname']);
			        // $headimgpath = "Uploads/Index/headimg/".$wxdata['openid'].".jpg";
            //      downimg($wxdata['headimgurl'],$headimgpath);
            //      $wxdata['headimgurl'] = "/".$headimgpath;
			        //通过openid查询是否存在这个微信用户
			        $wxuserinfo = $this->members->where(array('openid'=>$wxdata['openid']))->find();
			        if(empty($wxuserinfo)){  //如果数据库不存在这用户
			        	$top_id = S('top_id');
			        	$wxdata['top_id'] = $top_id ? $top_id : 0;
			        	$wxdata['create_time'] = time();
			        	$wxdata['type'] = 1;
			        	S('is_new',1,5);
		        		$wxdata['id'] = $this->members->add($wxdata); //把该用户的微信信息存入wxuser

		        		$wxdata = $this->members->find($wxdata['id']);
		        		$wxdata['nickname'] = base64_decode($wxdata['nickname']);
		        		$_SESSION['wechat'] = $wxdata;
		        		S('wechat', $wxdata);

		        		$this->redirect('Login/login');
		        	}else{  //如果存在这个微信用户则更新该用户的微信信息
		        		S('is_new',2,5);
						$wxdata['id'] = $wxuserinfo['id'];
						$wxdata['type'] = 1;
						$this->members->save($wxdata);
		        	}
	        		$wxdata = $this->members->find($wxdata['id']);
	        		$wxdata['nickname'] = base64_decode($wxdata['nickname']);
	        		$_SESSION['wechat'] = $wxdata;
	        		S('wechat', $wxdata);
	        		$this->redirect('Login/login');
	        	}else{
			        //网页授权方法
			       	echo "<script>window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'</script>";exit;
	        	}
	      	}else{
		        //网页授权方法
		       	echo "<script>window.location.href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'</script>";exit;
	      	}
    	}
	}
	//获取access_token并全局缓存
	public function get_access_token(){
		static $access_token;
		$access_token = S('weixin_access_token');
		if($access_token) { //已缓存，直接使用
			return $access_token;
		} else { //获取access_token
			$url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='. $this->appid . '&secret=' . $this->appsecret;
			$access = json_decode($this->curls($url), true);
			// 缓存数据7200秒
			S('weixin_access_token',$access['access_token'],7200);
			return $access['access_token'];
		}
	}
	//获取jsapi_ticket并全局缓存
	public function get_jsapi_ticket(){
		static $jsapi_ticket;
		$jsapi_ticket = S('jsapi_ticket');
		if($jsapi_ticket) { //已缓存，直接使用
			return $jsapi_ticket;
		} else { //获取ticket
			$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->get_access_token().'&type=jsapi';
			$jsapi = json_decode($this->curls($url), true);
			// 缓存数据7200秒
			S('jsapi_ticket',$jsapi['ticket'],7200);
			return $jsapi['ticket'];
		}
	}
	//生成分享所需随机串
    public function get_nonceStr(){
    	$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";
		$nonceStr = '';
		for ($i=0; $i<16; $i++){
			$nonceStr.= $str[mt_rand(0, strlen($str)-1)];
		}
		return $nonceStr;
    }
    //通过接口，获取当前微信用户是否已关注公众号
    public function get_subscribe($openid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->get_access_token()."&openid=".$openid."&lang=zh_CN";
        $sub = $this->curls($url);
        $sub = json_decode($sub,true);
        return $sub['subscribe'];
    }
    //发送微信文本通知
    public function send_text($openid,$text){
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->get_access_token();
    	$post_data = '{"touser":"'.$openid.'","msgtype":"text","text":{"content":"'.$text.'"}}';
    	$data = $this->curlPost($url,$post_data,0);
    }
    //发送微信文本(图文)通知-------可以链接
    public function send_news($openid,$title,$text,$url){  //text的内容，用\n换行
    	$myurl = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->get_access_token();
    	$post_data = '{"touser": "'.$openid.'","msgtype": "news","news": {"articles": [{"title": "'.$title.'", "description": "'.$text.'","url":"'.$url.'"}]}}';
    	$data = $this->curlPost($myurl,$post_data,0);
    }

     /**
     * 微信退款
     * @param string $table 支付订单表
     * @param string $title 支付描述
     * @param string $price 支付金额
     * @param string $ordercode 订单编号
     * @return 微信支付的所需字符串
     */

    public function weixinRefund($ordercode='',$money=0.01){
        $out_refund_no = randomCode(1);
        $base = M('base')->where(array('id'=>1))->find();
        Vendor('Wxpay.WxPayApi');
        $input = new \WxPayRefund();
        $money = $money*100;
        //②、统一下单
        $input->SetOut_trade_no($ordercode);
        $input->SetOut_refund_no($out_refund_no);           //设置回调数据所需要的值
        $input->SetTotal_fee($money);
        $input->SetRefund_fee($money);
        $input->SetOp_user_id($base['mchid']);
        $resObj = \WxPayApi::refund($input);
        $arr = array(
           'result_code'=>$resObj['result_code'],
           'ordercode'=>$resObj['out_trade_no'],
           'return_msg'=>$resObj['return_msg']
        );
        return $arr;
    }
}