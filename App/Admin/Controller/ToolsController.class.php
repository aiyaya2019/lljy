<?php
namespace Admin\Controller;
use Think\Controller;
class ToolsController extends CommonController {
	public function email(){
		$this->emailconfig = S('emailconfig');
		$this->data=M('sendemail')->select();
		$this->display();
	}
	public function emailConfig(){
		S('emailconfig',I('post.'),3600*24*100);
		echo 1;
	}
	public function email_edit(){
		$this->data=M('sendemail')->find(I('get.id'));
		$this->display();
	}
	public function email_editHandle(){
		if(!IS_POST) E('页面不存在');
		$data = I('post.');
		$data['create_time'] = time();
		$rs = $this->sendMail(I('post.send'),I('post.title'),I('post.content'));
		if($rs==1){
			if(M('sendemail')->add($data)){
				$this->success('发送成功！！！',U('Tools/email'));
			}
		}else{
			$data['status'] = 1;
			$data['admin'] = session('username');
		    M('sendemail')->add($data);
			$this->error('发送失败');
		}	
	}
	//邮件删除
	public function email_search() {
		$id = I('get.id');
		$data = $this->finddata('sendemail',array('id'=>$id));
		$this->data = $data;
		$this->display();
	}
	//邮件删除
	public function email_delete() {
		$id = I('post.id');
		$rs = $this->deletedata('sendemail',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}
	//短信发送列表
	public function messages(){
		$this->data=M('sendmsg')->select();
		$this->display();
	}
	//短信发送视图
	public function messages_edit(){
		$this->data=M('sendmsg')->find(I('get.id'));
		$this->display();
	}
	//短信发送表单处理
	public function messages_editHandle(){
		
	}
	//短信删除方法
	public function messages_delete() {
		$id = I('post.id');
		$rs = $this->deletedata('sendmsg',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}

}
?>