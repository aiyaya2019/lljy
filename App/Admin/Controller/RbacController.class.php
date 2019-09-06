<?php
namespace Admin\Controller;
use Think\Controller;
class RbacController extends CommonController {
	//管理员列表
	Public function admin(){
		$data = D('AdminRelation')->relation(true)->field('password',true)->select();
		$this->admin=$data;
		$this->display();
	}
	//添加管理员
	Public function admin_edit(){
		$user_id = I('get.user_id');
		if(!empty($user_id)){
			$data = D('AdminRelation')->relation(true)->where(array('id'=>$user_id))->find();
			$this->data = $data;
		}
		$this->role = M('role')->select();
		$this->display();
	}
	//添加管理员表单处理
	Public function admin_editHandle(){
		$user_id = I('get.user_id');
		$role_id = I('post.role_id');
		$data = I('post.');
		if(empty($user_id)){
			$data['password'] = I('post.password','','md5');
			$data['create_time'] = time();
			$uid = M('admin')->add($data);
			$data = array(
				'role_id' => $role_id,
				'user_id' => $uid
			);
			if(M('role_user')->add($data)){
				$this->success('添加成功',U('Rbac/admin'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$data['loginip']=get_client_ip();
			if($_POST['password'] != ""){
				$data['password'] = I('post.password','','md5');
			}else{
				$data = bykeyarr($data,'password');
			}
			M('role_user')->where(array('user_id'=>$user_id))->setField("role_id",$role_id);
			if(M('admin')->where(array('id'=>$user_id))->save($data)){
				$this->success('修改成功',U('Rbac/admin'));
			}else{
				$this->error('修改失败');
			}
		}
	}
	// 管理员删除
	public function admin_delete(){
		$id  = I('post.id');
		$rs  = $this->deletedata('admin',array('id'=>$id));
		$rs1 = $this->deletedata('role_user',array('user_id'=>$id));
		if ($rs && $rs1) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}

	//角色列表
	Public function role(){
		$data = $this->selectdata('role','','','sort ASC');
		$this->data =$data;
		$this->display();
	}

	//添加角色
	Public function role_edit(){
		$id = I('get.id');
		if($id){
			$this->data= $this->finddata('role',array('id'=>$id));
		}
		$this->display();
	}
	
	//添加角色表单处理
	Public function role_editHandle(){
		$data = I('post.');
		$id = I('get.id');
		if($id){
			$data['id'] = $id;
			$data['update_time'] = time();
			$data['admin_id'] = $_SESSION['admin_id'];
			$this->savedata('role',$data,U('Rbac/role'));       //数据修改操作
		}else{
			$data['create_time'] = time();
			$data['admin_id'] = $_SESSION['admin_id'];
			$this->adddata('role',$data,U('Rbac/role'));         //数据添加操作
		}
	}
	// 删除角色表单处理
	Public function role_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('role',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}





	//节点列表
	Public function node(){
		$data = M('node')->select();
		$data = category($data);
		$this->data = $data;
		$this->display();
	}
	//配置权限
	Public function access(){
		$rid=I('rid',0,'intval');
		$field = array('id','name','title','pid');
		$node = M('node')->order('sort')->field($field)->select();
		//原有权限
		$access = M('access')->where(array('role_id'=>$rid))->getField('node_id',true);
		$this->node = node_merge($node,$access);
		// dump($node);
		// die;
		$this->rid = $rid;
		$this->display();
	}
	//配置权限表单处理
	Public function setAccess(){
		$rid = I('rid', 0 ,'intval');
		$db = M('access');
		$db->where(array('role_id' =>$rid))->delete();
		$data = array();
		foreach ($_POST['access'] as $v) {
			$data[]=array(
				'role_id'=>$rid,
				'node_id'=>$v,
				);
		}
		if($db->addAll($data)){
			$this->success("修改成功！！！",U('Rbac/role'));
		}else{
			$this->error('修改失败！！！');
		}
	}
	// 添加节点
	Public function node_edit(){
		$this->pid = I('pid',0,'intval');
		$this->level = I('level',1,'intval');
		switch ($this->level){
			case 1:
			$this->type = '应用';
			break;
			case 2:
			$this->type = '控制器';
			break;
			case 3:
			$this->type = '动作方法';
			break;
		}
		$this->display();
	}
	//删除节点
	Public function delNode(){
		if(M('node')->delete(I('get.pid'))){
			$this->success('删除成功！！！');
		}else{
			$this->error('删除失败！！！');
		}
	}
	//添加节点表单出来
	Public function addNodeHandle(){
		if(M('node')->add($_POST)){
			$this->success('添加成功！！！',U('Rbac/node'));
		}else{
			$this->error('添加失败！！！');
		}
	}
}