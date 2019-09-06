<?php
namespace Index\Controller;
use Think\Controller;
class PayController extends CommonController{
	//微信支付统一页面
	public function wxpay(){
        // print_r($_SESSION);exit;
         // dump($_SESSION);
        header("Content-type:text/html;charset=utf-8");
        if(isset($_SESSION['pay']['data'])){
            $pay = $_SESSION['pay'];
            $jsApiParameters = $this->weixinPay($pay['data']['table'],$pay['data']['title'],$pay['data']['money'],$pay['data']['ordercode']);
            //dump($jsApiParameters);
            $this->jsApiParameters = $jsApiParameters;
            $money = $this->finddata('members',array('id'=>$this->members_id),'money');
            $this->money = $money ? $money:0;
        }
        $this->share = $this->share(1);
        
        $this->title = $_SESSION['pay']['data']['title'];
        $this->display();
    }
    
}
?>