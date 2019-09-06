<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;

class TipsController extends CommonController {
	/**
     * 领取须知
     */
    public function index(){
        $tips = M('tips')->field('id, content')->where(['status' => '1'])->order('id desc')->find();
        $this->tips = $tips;
    	$this->display();
    }
}