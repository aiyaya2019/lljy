<?php
namespace Admin\Controller;
use Think\Controller;
Class LoginController extends Controller{
	//login模板
	Public function index(){
		// $cutMoneyArr = cutMoney(1000,3);
	   $this->display();
	}
	//验证码
	Public function code(){
		import('Class.Vcode',APP_PATH,'.php');
		$config = array("width" => 80, "height" => 45, "count" => 4, "str" => 2); //配置
        $vcode =new \Vcode($config);
        $vcode->getCode();                            //获取验证码
        $vcode->getImg();                             //输出图片
	}
	//登录表单处理
	Public function loginHandel(){
		if(!IS_AJAX) E('页面不存在');
		$name = I('post.name');
		$pwd  = I('post.password','','md5');
		$code = I('post.code','','strtolower');
		$admin = M('admin')->where(array('name' =>$name))->find();
		if(session('code') != $code){
			$data = array('code'=>1,'msg'=>"验证码错误");
			$this->ajaxReturn($data);
		}
		if(!$admin || $admin['password'] != $pwd){
			$data = array('code'=>2,'msg'=>"账号或密码错误");
			$this->ajaxReturn($data);
		}
		if($admin['lock']==1){
			$data = array('code'=>3,'msg'=>"用户被锁");
			$this->ajaxReturn($data);
		}
		session('admin_id',$admin['id']);
        session('admin_name',$admin['name']);
        //超级管理员识别
        if($name == C('ADMIN_AUTH_KEY')){
            session(C('ADMIN_AUTH_KEY'),$name);
        }else{
            \Org\Util\Rbac::saveAccessList($admin['id']);
        }
	    $data = array('code'=>6,'msg'=>"登录成功");
		$this->ajaxReturn($data);
	}
}
?>