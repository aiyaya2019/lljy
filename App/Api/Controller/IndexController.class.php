<?php
namespace Api\Controller;
use Think\Controller;

/**
 * 首页控制器--小程序
 */
class IndexController extends CommonController {

	/**
	 * 首页编辑按钮
	 */
	public function isHide(){
		$res = M('base')->where(['id' => '1'])->find();
		if ($res) {
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $res['is_hide']]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '获取失败，请联系管理员']);
		}
	}









}