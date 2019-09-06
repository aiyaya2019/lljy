<?php
namespace Admin\Controller;
use Think\Controller;
class LogisticsController extends CommonController {
	// 快递列表
	public function logistics(){
		$pagedata = $this->Page('logistics',C('page'));  //$table为分页表名，$num分页显示数据返回limit值和分页样式
		$this->page=$pagedata['page'];
		$data = M('logistics')->limit($pagedata['limit'])->select();
		// dump($data);die;
		$this->data = $data;
		$this->display();
	}
	// 快递添加和编辑
	public function logistics_edit(){
		$id = I('get.id');
		if ($id) {
			$data=M('logistics')->where(array('id'=>$id))->find();
			$this->data=$data;
		}
		$this->display();
	}
	// 快递添加和编辑数据处理
	public function logistics_editHandle(){
		if(!IS_POST) E('页面不存在');
		$id = I('get.id');
		$data = I('post.');
		if(empty($id)){
			$data['create_time'] = time();
			if(M('logistics')->add($data)){
				$this->success('添加成功！！！',U('Logistics/logistics'));
			}else{
				$this->error('添加失败！！！');
			}
		}else{
			$data['update_time']=time();
			if(M('logistics')->where(array('id'=>$id))->data($data)->save()){
				$this->success('保存成功！！！',U('Logistics/logistics'));
			}else{
				$this->error('保存失败！！！');
			}
		}
	}
    // 快递删除操作
	public function logistics_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('logistics',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}

	// 运费模板列表
	public function tpl(){
		$pagedata = $this->Page('logistics_tpl',C('page'));  //$table为分页表名，$num分页显示数据返回limit值和分页样式
		$this->page=$pagedata['page'];
		$data = M('logistics_tpl')->limit($pagedata['limit'])->select();
		//dump($data);die;
		$this->data = $data;
		$this->display();
	}

	// 运费模板添加和编辑
	public function tpl_edit(){
		$id = I('get.id');
		if ($id) {
			$data=M('logistics_tpl')->where(array('id'=>$id))->find();
			$this->data=$data;
		}
		$this->display();
	}

	// 运费模板添加和编辑数据处理
	public function tpl_editHandle(){
		if(!IS_POST) E('页面不存在');
		$id = I('get.id');
		$data = I('post.');
		if(empty($id)){
			$data['create_time'] = time();
			if(M('logistics_tpl')->add($data)){
				$this->success('添加成功！！！',U('Logistics/tpl'));
			}else{
				$this->error('添加失败！！！');
			}
		}else{
			$data['update_time']=time();
			if(M('logistics_tpl')->where(array('id'=>$id))->data($data)->save()){
				$this->success('保存成功！！！',U('Logistics/tpl'));
			}else{
				$this->error('保存失败！！！');
			}
		}
	}

    // 运费模板删除操作
	public function tpl_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('logistics_tpl',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}
}
?>