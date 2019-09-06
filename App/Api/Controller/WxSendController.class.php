<?php
namespace Api\Controller;
use Think\Controller;
class WxSendController extends Controller {
    // 发送图文消息
    public function apisendMsg(){
        $httpjson = file_get_contents("php://input");
        $httparr = json_decode($httpjson,1);
        $members_id = $httparr['members_id'];
        $title = $httparr['title'];
        $content = $httparr['content'];
        $url = $httparr['url'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'没有用户ID'));
           return false;
        }
        $openid = M('members')->where(array('id'=>$members_id))->getField('openid');
        $rs = A("Index/WechatApi")->send_news($openid,$title,$content,$url);
        echo encode(array('code'=>1,'msg'=>'结果'));
    }
}