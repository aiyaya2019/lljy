<?php
namespace Admin\Controller;
use Think\Controller;

class ApplyController extends CommonController {

	/**
	 * 学员列表
	 */
	public function apply(){
		$keywords = I('get.keywords');
		if ($keywords) {
			$where['name'] = array('like', $keywords, 'or');
		}
		$where['flag'] = ['eq', '1'];
		$where['status'] = ['eq', '1'];

		$pagedata = $this->page('apply',C('page'),$where);
		$data = M('apply')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		$this->data=$data;
		$this->page = $pagedata['page'];
		$this->display();
	}

	/**
	 * 添加/编辑
	 */
	public function apply_edit(){
		$id = I('get.id');
		if (IS_POST) {
			$data = I('post.');
			if(empty($id)){
				$data['create_time'] = time();
				$this->adddata('apply',$data,U('apply/apply')); //数据添加操作
			}else{
				$data['id']=$id; 
				$data['update_time'] = time();
				$this->savedata('apply',$data,U('apply/apply'));//数据修改操作
			}
		}else{
			if ($id) {
				$data = M('apply')->where(array('id' => $id))->find();
			    $this->data = $data;
			}
			$this->display();
		}
	}

    /**
     * 删除处理
     */
	public function  apply_delete(){
		$id = I('post.id');
		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('apply', $where, '1');
		}else{
			$rs = $this->deletedata('apply', array('id'=>$id), '1');
		}
		
		if ($rs) {
			$this->ajaxReturn(array('code' => '6','msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1','msg' => '删除失败，可能少主键id'));
		}
    }






}
?>