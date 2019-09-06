<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {

	public function index(){
		$this->display();
	}

	// 0未支付，1已支付
	//后台欢迎页
	public function welcome(){
		// 订单统计
		$status0 = M('order')->where(['status' => '0'])->count('id');
		$status1 = M('order')->where(['status' => '1'])->count('id');
		$order = array(
			"status0"=>$status0,
			"status1"=>$status1,
		);

		// 今日购买用户数
		$start_time = strtotime(date('Y-m-d'));
		$end_time   = $start_time + '86399';
		$where      = array('pay_time'=>array("between","$start_time,$end_time"),'status'=>array('eq','1'));
		$members['nowday']     = M('order')->where($where)->group('members_id')->count('id');

		// 购买用户总数
		$members['buy'] = M('order')->where(['status' => '1'])->group('members_id')->count('id');

		// 总用户
		$members['all'] = M('members')->count('id');
		$data = [
			'order'   => $order,
			'members' => $members,
		];

		$this->data = $data;

		$this->display();
	}

	//退出登录
	Public function logout(){
		session_unset();
		session_destroy();
		$this->redirect('Login/index');
	}

	//删除数据库碎片
	public function clear(){
		$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
		$table = $Model->query('show tables');
		foreach($table as $k => $v){
		   $Model->query('optimize table '.'tbkl_'.$v);
		}
		$this->success('数据库碎片清除成功');
	}
	
	//删除日志
	public function clearLog(){
		deleteDir(RUNTIME_PATH.'Logs');
		$this->success('Log日志清除成功');
	}
}
?>