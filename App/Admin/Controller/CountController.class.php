<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 统计控制器
 */
class CountController extends CommonController {

	/**
	 * 统计
	 */
	public function count(){
		// $keywords = I('get.keywords');
		// if ($keywords) {
		// 	$where['name'] = array('like', $keywords, 'or');
		// }
		// $where['flag'] = ['eq', '1'];
		// $where['status'] = ['eq', '1'];

		// $pagedata = $this->page('apply',C('page'),$where);
		// $data = M('apply')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		// $this->data=$data;
		// $this->page = $pagedata['page'];
		$this->display();
	}






}
?>