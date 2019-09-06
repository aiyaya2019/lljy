<?php
namespace Admin\Controller;
use Think\Controller;
class ShareController extends CommonController {
	// 业务员列表
	public function share(){
		$pagedata = $this->Page('share',C('page'));
		$data=M('share')->where($where)->limit($pagedata['limit'])->select();
		$this->page=$pagedata['page'];
		$this->data = $data;
		$this->display();
	}
	// 业务员添加和编辑
	public function share_edit(){
		$id = I('get.id');
		if ($id) {
			$data=M('share')->where(array('id'=>$id))->find();
			$this->data=$data;
		}
		$this->display();
	}
	//添加/修改轮播图表单处理
	Public function share_editHandle(){
		$id = I('get.id');
		$data = I('post.');
		if(empty($id)){
			$data['create_time'] = time();
			if(M('share')->add($data)){
				$this->success('添加成功！！！',U('Share/share'));
			}else{
				$this->error('添加失败！！！');
			}
		}else{
			$data['update_time']=time();
			if(M('share')->where(array('id'=>$id))->data($data)->save() || $rs){
				$this->success('保存成功！！！',U('Share/share'));
			}else{
				$this->error('保存失败！！！');
			}
		}
	}
	// 业务员删除操作
	public function share_delete(){
		$id = I('post.id');
		// print_r($id);exit;
		$rs = $this->deletedata('share',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}
}
?>