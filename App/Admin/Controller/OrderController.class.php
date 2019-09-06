<?php
namespace Admin\Controller;
use Think\Controller;

class OrderController extends CommonController {

    /**
     * 订单列表
     */
	public function order(){
		$keywords   = I('get.keywords');
		$status     = I('get.status');
		$start_time = I('get.start_time');
		$end_time   = I('get.end_time');
		$members_id = I('get.members_id');

		$where['o.flag'] = ['eq', '1'];
		$map['flag']     = ['eq', '1'];

		if ($members_id) {
			$map['members_id']     = ['eq', $members_id];
			$where['o.members_id'] = ['eq', $members_id];
		}

		// 关键词筛选
		if ($keywords) {
			$map['ordercode'] = array('like', $keywords);
			$where['o.ordercode'] = array('like', $keywords);
		}
		// 状态筛选
		if ($status != null) {
			$map['status'] = ['eq', $status];
			$where['o.status'] = ['eq', $status];
		}
		// 时间筛选
		if ($start_time && $end_time) {
			$start_time = strtotime($start_time);
			$end_time   = strtotime($end_time) + '86399';
			$where['o.create_time'] = [['EGT', $start_time], ['ELT', $end_time], 'AND'];
			$map['create_time']     = [['EGT', $start_time], ['ELT', $end_time], 'AND'];

		}elseif($start_time && !$end_time){
			$start_time = strtotime($start_time);
			$where['o.create_time'] = [['EGT', $start_time]];
			$map['create_time']     = [['EGT', $start_time]];

		}elseif(!$start_time && $end_time){
			$end_time   = strtotime($end_time) + '86399';
			$where['o.create_time'] = [['ELT', $end_time]];
			$map['create_time']     = [['ELT', $end_time]];
		}
		
		$pagedata = $this->page('order',C('page'),$map);

		// $field = ('m.headimgurl, m.nickname, m.userphone, o.id, o.ordercode, o.members_id, o.vip_id, o.vip_name, o.video_id, o.pay_money, o.type, o.status, o.create_time, v.title, v.pic, v.video');
		// $data = M('order as o')
		// 	->join('tbkl_members as m on o.members_id = m.id', 'left')
		// 	->join('tbkl_video as v on o.video_id = v.id', 'left')
		// 	->field($field)
		// 	->where($where)
		// 	->order('id desc')
		// 	->limit($pagedata['limit'])
		// 	->select();
		
		$field = ('m.headimgurl, m.nickname, m.userphone, o.id, o.ordercode, o.members_id, o.vip_id, o.video_id, o.pay_money, o.type, o.pay_time, o.status, o.create_time, i.vip_name, i.vip_price, i.cate_id, i.cate_name, i.title, i.pic, i.video, i.video_price, i.show_time, i.desp, i.content, i.is_pay');
		$data = M('order as o')
			->join('tbkl_members as m on o.members_id = m.id', 'left')
			->join('tbkl_order_info as i on o.ordercode = i.ordercode', 'left')
			->field($field)
			->where($where)
			->order('id desc')
			->limit($pagedata['limit'])
			->select();



		$count['all_num']   = M('order')->where($map)->count('id');//订单总数
		$count['all_money'] = M('order')->where($map)->sum('pay_money');//总金额
		$this->data  = $data;
		$this->count = $count;
		$this->page  = $pagedata['page'];
		$this->display();
	}

    /**
     * 订单删除处理
     */
	public function order_delete(){
		$id = I('post.id');
		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('order', $where, '1');
		}else{
			$rs = $this->deletedata('order', array('id'=>$id), '1');
		}
		
		if ($rs) {
			$this->ajaxReturn(array('code' => '6','msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1','msg' => '删除失败，可能少主键id'));
		}
    }



}
?>