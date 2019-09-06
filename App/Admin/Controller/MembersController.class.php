<?php
namespace Admin\Controller;
use Think\Controller;
class MembersController extends CommonController {
	//会员列表
	Public function index(){
		$type = I('get.type');
		if($type){
			$where['type'] = $type;
		}
		$pagedata = $this->page('members',C('page'),$where);
		$data = M('members')->where($where)->limit($pagedata['limit'])->order('id desc')->select();

		$this->data = $data;
		$this->page = $pagedata['page'];

		$this->display();
	}

	//添加、修改会员
	Public function search(){
		if($id = $_GET['id']){
			$this->data=M('members')->find($id);
			$this->display();
		}
		$this->display();
	}
	//添加/修改会员表单处理
	Public function editHandle(){
		$data = I('post.');
		$id = I('get.id');
		if($id){
			$data['id'] = $id;
			$data['update_time'] = time();
			$this->savedata('members',$data,U('Members/index'));       //数据修改操作
		}else{
			$this->adddata('members',$data,U('Members/index'));         //数据添加操作
		}
	}


	// 多个删除
	public function delMore(){
		$ids   = I('post.ids');
		if (empty($ids)) {
			echo json_encode(['code' => '0', 'msg' => '缺少参数ids']);return;
		}
		$ids = implode(',', $ids);
		$where['id'] = ['in', $ids];
		$res = $this->deletedata('members', $where);
		if($res){
			$this->ajaxReturn(array('code' => '6','msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1','msg' => '删除失败，可能少主键id'));
		}	
	}


	/**
	 * 会员反馈列表
	 */
	public function messages(){
		$pagedata = $this->page('messages',C('page'));
		$this->data=D('MessagesRelation')->relation(true)->order('id ASC')->limit($pagedata['limit'])->select();
		$this->page = $pagedata['page'];
		$this->display();
	}
	public function messages_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('messages',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}











}
?>