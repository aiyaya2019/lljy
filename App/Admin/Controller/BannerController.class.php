<?php
namespace Admin\Controller;
use Think\Controller;
class BannerController extends CommonController {
	// 轮播图列表
	public function banner(){
		$keywords = I('get.keywords');
		if ($keywords) {
			$where = "title like '%$keywords%'";
		}
		
		$pagedata = $this->page('banner',C('page'),$where);
		$data = M('banner')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		$this->data=$data;
		$this->page = $pagedata['page'];
		$this->display();
	}

	// 轮播图添加/编辑数据处理
	public function banner_edit(){
		$id = I('get.id');
		if (IS_POST) {
			$data = I('post.');
			$data['content']= I('post.content','','htmlspecialchars_decode');
			if(empty($id)){
				$data['create_time'] = time();
				if(M('banner')->add($data)){
					$this->success('添加成功！！！',U('Banner/banner'));
				}else{
					$this->error('添加失败！！！');
				}
			}else{
				$data['id']=$id; 
				$data['update_time']=time();
				$res = $this->savedata('banner',$data,U('Banner/banner'));       //数据修改操作
			}
		}else{
			if ($id) {
				$data = M('banner')->where(array('id'=>$id))->find();
			    $this->data = $data;
			}
			$this->display();
		}

	}

	// 轮播图添加/编辑数据处理
	// public function banner_editHandle(){
	// 	if(!IS_POST) E('页面不存在');
	// 	$id = I('get.id');
	// 	$data = I('post.');
	// 	$data['content']= I('post.content','','htmlspecialchars_decode');
	// 	if(empty($id)){
	// 		$data['create_time'] = time();
	// 		if(M('banner')->add($data)){
	// 			$this->success('添加成功！！！',U('Banner/banner'));
	// 		}else{
	// 			$this->error('添加失败！！！');
	// 		}
	// 	}else{
	// 		$data['id']=$id; 
	// 		$data['update_time']=time();
	// 		$res = $this->savedata('banner',$data,U('Banner/banner'));       //数据修改操作
	// 	}
	// }

    // 轮播图删除处理
	public function banner_delete(){
		$id = I('post.id');
		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('banner', $where);
		}else{
			$rs = $this->deletedata('banner', array('id'=>$id));
		}
		
		if ($rs) {
			$this->ajaxReturn(array('code' => '6','msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1','msg' => '删除失败，可能少主键id'));
		}
    }







}
?>