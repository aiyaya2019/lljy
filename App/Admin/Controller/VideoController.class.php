<?php
namespace Admin\Controller;
use Think\Controller;

class VideoController extends CommonController {
	/**
	 * 视频列表
	 */
	public function video(){
		$keywords = I('get.keywords');
		// 分类筛选
		$cate_id = I('get.cate_id');
		if ($keywords && $cate_id) {
			$where = "title like '%$keywords%' and cate_id=" .$cate_id;
		}elseif ($keywords && !$cate_id) {
			$where = "title like '%$keywords%'";
		}elseif (!$keywords && $cate_id) {
			$where ="cate_id=" .$cate_id;
		}
		
		$pagedata = $this->page('video',C('page'),$where);
		$data = M('video')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		$cate = M('video_cate')->field('id, name')->where(['status' => '1'])->select();
		$this->video_cate = $cate;
		$cate = array_column($cate, null, 'id');
		if ($data) {
			foreach ($data as $key => &$value) {
				$data[$key]['cate_name'] = $cate[$value['cate_id']]['name'];
			}
		}
		$this->data=$data;
		$this->page = $pagedata['page'];
		$this->display();
	}

	/**
	 * 视频添加/编辑
	 */
	public function video_edit(){
		$id = I('get.id');
		if (IS_POST) {
			$data = I('post.');
			$data['content']   = I('post.content','','htmlspecialchars_decode');
			$data['show_time'] = time($data['show_time']);
			if (!$data['pic']) {
				$this->error('请上传图片');
			}
			if ($data['is_pay'] == '0') {
				$data['price'] = '0.00';
			}
			if(empty($id)){
				$data['create_time'] = time();
				$this->adddata('video',$data,U('video/video')); //数据添加操作
			}else{
				$data['id']=$id; 
				$data['show_time']   = time($data['show_time']);
				$data['update_time'] = time();
				$this->savedata('video',$data,U('video/video'));//数据修改操作
			}
		}else{
			if ($id) {
				$data = M('video')->where(array('id' => $id))->find();
			    $this->data = $data;
			}
			$cate = M('video_cate')->where(array('status' => '1'))->select();// 分类
		    $this->cate = $cate;
			$this->display();
		}
	}

    /**
     * 视频删除处理
     */
	public function video_delete(){
		$id = I('post.id');
		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('video', $where);
		}else{
			$rs = $this->deletedata('video', array('id'=>$id));
		}
		
		if ($rs) {
			$this->ajaxReturn(array('code' => '6','msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1','msg' => '删除失败，可能少主键id'));
		}
    }



// ===================================视频分类=============================================

    /**
     * 视频分类列表
     */
    public function video_cate(){
		$keywords = I('get.keywords');
		if ($keywords) {
			$where = "name like '%$keywords%'";
		}
		$pagedata = $this->page('video_cate',C('page'),$where);
		$data=M('video_cate')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		$this->data=$data;
		$this->page = $pagedata['page'];
		$this->display('cate');
    }

    /**
     * 视频分类添/编辑
     */
	public function cate_edit(){
		$id = I('get.id');
		if (IS_POST) {
			$data = I('post.');
			if(empty($id)){
				$data['create_time'] = time();
				$this->adddata('video_cate',$data,U('video/video_cate')); //数据添加操作
			}else{
				$data['id']=$id; 
				$data['update_time']=time();
				$this->savedata('video_cate',$data,U('video/video_cate'));//数据修改操作
			}
		}else{
			if ($id) {
				$data=M('video_cate')->where(array('id'=>$id))->find();
			    $this->data=$data;
			}
			$this->display('cate_edit');
		}
	}

    /**
     * 视频分类删除处理
     */
	public function cate_delete(){
		$id = I('post.id');

		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('video_cate', $where);
		}else{
			$rs = $this->deletedata('video_cate', array('id'=>$id));
		}

		if ($rs) {
			$this->ajaxReturn(array('code' => '6', 'msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1', 'msg' => '删除失败，可能少主键id'));
		}
    }


// ===================================vip=============================================

    /**
     * vip列表
     */
    public function vip(){
		$keywords = I('get.keywords');
		if ($keywords) {
			$where = "name like '%$keywords%'";
		}
		$pagedata = $this->page('vip',C('page'),$where);
		$data=M('vip')->order('id desc')->where($where)->limit($pagedata['limit'])->select();
		$this->data=$data;
		$this->page = $pagedata['page'];
		$this->display('vip');
    }

    /**
     * vip添加/编辑
     */
	public function vip_edit(){
		$id = I('get.id');
		if (IS_POST) {
			$data = I('post.');
			if(empty($id)){
				$data['create_time'] = time();
				$this->adddata('vip',$data,U('video/vip')); //数据添加操作
			}else{
				$data['id']=$id; 
				$data['update_time']=time();
				$this->savedata('vip',$data,U('video/vip'));//数据修改操作
			}
		}else{
			if ($id) {
				$data=M('vip')->where(array('id'=>$id))->find();
			    $this->data=$data;
			}
			$this->display('vip_edit');
		}
	}

    /**
     * vip删除
     */
	public function vip_delete(){
		$id = I('post.id');

		if (is_array($id)) {
			$id = implode(',', $id);
			$where['id'] = ['in', $id];
			$rs = $this->deletedata('vip', $where);
		}else{
			$rs = $this->deletedata('vip', array('id'=>$id));
		}

		if ($rs) {
			$this->ajaxReturn(array('code' => '6', 'msg' => '删除成功'));
		}else{
			$this->ajaxReturn(array('code' => '1', 'msg' => '删除失败，可能少主键id'));
		}
    }

}
?>