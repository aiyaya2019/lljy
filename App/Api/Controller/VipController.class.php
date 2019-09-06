<?php
namespace Api\Controller;
use Think\Controller;

/**
 * vip控制器--小程序
 */
class VipController extends CommonController {

	/**
	 * vip列表
	 */
	public function vip(){
		$vip = M('vip')->field('id, name, price, is_red, term')->where(['status' => '1'])->order('id desc')->select();
		if ($vip) {
			foreach ($vip as $key => &$value) {
				$vip[$key]['all_price'] = sprintf('%.2f', $value['term'] * $value['price']);
			}
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $vip]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据']);
		}
	}



}