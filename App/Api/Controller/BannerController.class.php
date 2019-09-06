<?php
namespace Api\Controller;
use Think\Controller;

/**
 * 轮播图控制器--小程序
 */
class BannerController extends CommonController {

	public function banner(){
		$banner = M('banner')->field('id, name, pic, url')->where(['place' => '1', 'status' => '1'])->order('sort asc')->limit('5')->select();
		$res = M('base')->where(['id' => '1'])->find();
		if ($banner) {
			foreach ($banner as $key => &$value) {
				if (stristr($value['url'], '?')) {
					$banner[$key]['url'] = $value['url'] .'&name=' .$value['name'];
				}else{

					$banner[$key]['url'] = $value['url'] .'?id=' .$value['id'] .'&name=' .$value['name'];
				}
			}
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $banner, 'is_hide' => $res['is_hide']]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据', 'is_hide' => $res['is_hide']]);
		}
	}









}