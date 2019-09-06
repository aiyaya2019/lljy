<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends CommonController {
	// 系统配置列表
	public function index(){
		$data=M('base')->find();
        // dump($data);
		$this->data = $data;
		$this->display();
	}
	// 数据添加和编辑数据处理
	public function baseHandle(){
		$data = I('post.');
		$data['id'] = 1;
		$data['update_time'] = time();
		$data['admin_id'] = $_SESSION['admin_id'];
		$this->savedata('base',$data,U('Base/index'));       //数据修改操作
	}
	// 帮助中心
	public function help(){
		$this->data=M('base')->field('help')->find();
		$this->display();
	}
	public function helpHandel(){
		$help = I('post.help','','htmlspecialchars_decode');
		$data = array(
			"id"=>1,
			"help"=>$help,
		);
    	$this->savedata('base',$data,U('Base/help'));       //数据修改操作
    }
	// URL管理视图
    public function url(){
    	$type = I('get.type');
    	if($type){
    		$where = array('type'=>$type);
    	}
    	$pagedata = $this->page('url',C('page'),$where);
    	$data=M('url')->order('sort ASC')->where($where)->order('type DESC')->limit($pagedata['limit'])->select();
    	$this->page = $pagedata['page'];
    	$this->data=$data;
    	$this->display();
    }
	// URL添加和编辑view
    public function url_edit(){
    	$id = I('get.id');
    	$data=M('url')->where(array('id'=>$id))->find();
    	$this->data=$data;
    	$this->display();
    }
	// URL添加和编辑数据处理
    public function url_editHandle(){
    	$data = I('post.');
    	$id = I('get.id');
    	if(empty($id)){
    		$data['create_time'] = time();
			$this->adddata('url',$data,U('Base/url')); //数据添加操作
		}else{
			$data['id']=$id;
			$data['update_time']=time();
			$this->savedata('url',$data,U('Base/url'));       //数据修改操作
		}
	}
    // 数据删除处理
	public function url_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('url',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}


    // 热门关键词数据处理
    public function keywords_Handle(){
    	$data = I('post.');
    	$id = I('get.id');
    	if($id){
    		$data['id'] = $id;
    		$data['update_time'] = time();
    		$this->savedata('keywords',$data,U('Base/keywords'));
    	}else{
    		$data['create_time'] = time();
    		$this->adddata('keywords',$data,U('Base/keywords'));
    	}
    }
    






















}
?>