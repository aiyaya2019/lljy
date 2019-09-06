<?php
namespace Admin\Controller;
use Think\Controller;

class OtherController extends CommonController {

    /**
     * 关于平台/报名说明/特权说明
     */
	public function other(){
		$id   = I('get.id');
		$type = I('get.type');
		if (IS_POST) {
			$data = I('post.');
			$data['content'] = I('post.content','','htmlspecialchars_decode');
			if(empty($id)){
				$data['create_time'] = time();
				$this->adddata('vip',$data,U('Other/other', ['type' => $type])); //数据添加操作
			}else{
				$data['id']=$id; 
				$data['update_time']=time();
				$this->savedata('other',$data,U('Other/other', ['type' => $type]));//数据修改操作
			}
		}else{
	        if ($type === null) {
	            $this->error('缺少参数');
	        }
	        if ($type == '0') {
	        	$this->title = '关于本平台';
	        }elseif ($type == '1') {
	        	$this->title = '报名说明';
	        }elseif ($type == '2') {
	        	$this->title = '特权说明';
	        }
	        $data = M('other')->where(['type' => $type])->find();
	        $this->data = $data;
	        $this->display();
		}
	}


}
?>