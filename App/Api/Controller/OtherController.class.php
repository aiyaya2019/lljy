<?php
namespace Api\Controller;
use Think\Controller;

class OtherController extends CommonController {

	/**
	 * 0关于本平台；1报名说明/报名同意条款；2会员特权说明
	 */
	public function other(){
		$request = json_decode(file_get_contents("php://input"), 1);
		$request = empty($request)?I('post.'):$request;
		$type    = $request['type'];
		// $type    = 1;
		if ($type === null) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数type']);return;
		}
		$res = M('other')->field('id, title, content')->where(['type' => $type])->find();
		if ($res) {
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $res]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '获取失败']);
		}
	}




}