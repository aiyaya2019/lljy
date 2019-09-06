<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class IndexController extends CommonController {
	/*入口首页*/
    public function index(){

        // 轮播图
        $banner = M('banner')->field('id, name, pic, url')->where(['status' => '1', 'place' => '1'])->order('sort asc')->select();
        // 公告
        $notice = M('notice')->field('id, title, content')->where(['status' => '1'])->order('id desc')->limit('1')->select();
        // 产品领取次数
        $number = M('number')->field('id, num, pic')->where(['status' => '1'])->order('id desc')->select();

        /* 微信公众号分享 */
        $this->sharedata = $this->share(1);

        $this->banner = $banner;
        $this->notice = $notice;
        $this->number = $number;
    	$this->display();
    }

    /**
     * 公告详情
     * $id 公告id
     */
    public function noticeInfo(){
        $id = I('get.id');
        if (!$id) {
            $this->error('缺少必需参数id');
        }
        $details = M('notice')->where(['id' => $id])->find();
        $this->details = $details;
        $this->display();
    }









}