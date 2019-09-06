<?php
namespace Api\Controller;
use Think\Controller;
class WechatApiController extends CommonController {
    //获取opeinid和key值
    public function getOpenid(){
    	$request = json_decode(file_get_contents('php://input'),1);
        $key = $request['key'];
        $code = $request['code'];
        $session = S($key);
        if($session) { //已缓存，直接使用
            $sdata = S($key);
            $data = array('openid'=>$sdata['openid'],'key'=>$key);
            $returndata = array('code'=>6,'msg'=>"获取成功",'data'=>$data);
        }else{ //获取access_token
            $config = $this->finddata('base',array('id'=>1));
            $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$config['sm_appid'].'&secret='.$config['sm_appsecret'].'&js_code='.$code.'&grant_type=authorization_code';
            $json = $this->curls($url);
            $result = json_decode($json,1);
            if($result['openid']){
            	$newkey = randomCode(2,6);
	            S($newkey,$result,7200);
	            $data = array('openid'=>$result['openid'],'key'=>$result['session_key']);
	            $returndata = array('code'=>6,'msg'=>"获取成功",'data'=>$data);
            }else{
            	echo encode(array('code'=>2,'msg'=>'获取失败,Wcode:'.$result['errcode']));
                return ;
            }
        }
        echo encode($returndata);
    }
    // 获取access_token
    public function getAccessToken(){
        $access_token = S('access_token');
        if($access_token){
           return $access_token;
        }else{
            $config = $this->finddata('base',array('id'=>1));
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$config['sm_appid']."&secret=".$config['sm_appsecret'];
            $json = file_get_contents($url);
            $result = json_decode($json,1);
            if ($result['access_token']) {
                S('access_token',$result['access_token'],7200);
                return $result['access_token'];
            }else{
                return $result['errmsg'];
            }
        }
    }
}