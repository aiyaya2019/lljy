<?php
namespace Admin\Controller;
use Think\Controller;
class AjaxController extends CommonController {
	/* 异步删除图片
     * @param string $path 图片的路径，于/Uploads/Admin/".$path."/"下
     * @return array 删除的状态
     */
	public function delpic(){
		if(!IS_AJAX) E('页面不存在');
		$path = I('post.path');
		$rs = unlink('./'.$path);
		return $rs;
	}
	/* 异步更新单个字段的方法
     * @param string $table 表名
     * @param string $id 主键id
     * @param string $field 更新字段名称
     * @param string $value 更新字段值
     * @return array 删除的状态
     */
	public function setField(){
		$table=I('post.table');
		$id=I('post.id');
		$field=I('post.field');
		$value=I('post.value','','htmlspecialchars_decode');
		$rs = M($table)->where('id='.$id)->setField($field,$value);
		if ($rs){
			$this->ajaxReturn(array('code'=>6,'msg'=>'修改成功',$field=>$value));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'修改失败'));
		}
	}
	/*异步判断是否有该会员*/
	public function is_phone(){
		$userphone = I('post.userphone');
		$rs = M('members')->where(array('userphone'=>$userphone))->count();
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'success'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'未查到该会员'));
		}
	}
	/* 异步发货 */
	public function order_logistics(){
		$order_id = I('post.order_id');
		$data = I('post.');
		$data['status'] = 2;
		$rs = M('mall_order')->where(array('id'=>$order_id))->save($data);
		if ($rs) {
			$wechat = A("Index/WechatApi");
			$mall_order = $this->finddata('mall_order',array('id'=>$order_id));
			$logistics =  $this->finddata('logistics',array('id'=>$data['logistics_id']));
			$openid = $data['openid'];
			$title = "发货提醒：";
			$text = "订单编号：".$mall_order['ordercode'];
			$text .= "\n发货时间：".date('Y年m月d日 H:i');
			$text .= "\n发货状态：已发货";
			$text .= "\n快递名称：".$logistics['name'];
			$text .= "\n快递单号：".$data['logistics_code'];
			$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].U('Index/Members/order',array('status'=>2));
			$wechat->send_news($openid,$title,$text,$url);
			$this->ajaxReturn(array('code'=>6,'msg'=>'发货成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'发货保存失败'));
		}
	}
	/* 异步发货 */
	public function group_order_logistics(){
		$order_id = I('post.order_id');
		$data = I('post.');
		$data['status'] = 3;
		$group_order = $this->finddata('group_order',array('id'=>$order_id));

		$rs = M('group_order_buy')->where(array('sub_ordercode'=>$data['sub_ordercode']))->save($data);
		if ($rs) {
			$group_num =  $group_order['group_num'];
			$logisticsNum = M('group_order_buy')->where(array('ordercode'=>$group_order['ordercode'],'status'=>3))->count();
			if ($group_num == $logisticsNum) {
				 M('group_order')->where(array('id'=>$order_id))->setField('status',3);
			}
			$wechat = A("Index/WechatApi");
			$mall_order = $this->finddata('group_order',array('id'=>$order_id));
			$logistics =  $this->finddata('logistics',array('id'=>$data['logistics_id']));
			$openid = $data['openid'];
			$title = "发货提醒：";
			$text = "订单编号：".$mall_order['ordercode'];
			$text .= "\n发货时间：".date('Y年m月d日 H:i');
			$text .= "\n发货状态：已发货";
			$text .= "\n快递名称：".$logistics['name'];
			$text .= "\n快递单号：".$data['logistics_code'];
			$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].U('Index/Members/order',array('status'=>2));
			$wechat->send_news($openid,$title,$text,$url);
			$this->ajaxReturn(array('code'=>6,'msg'=>'发货成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'发货保存失败'));
		}
	}
	/* 判断是否有这个会员  */
	public function is_HaveMembers(){
		$phone = I('post.phone');
		$rs = M('members')->where(array('userphone'=>$phone))->find();
		if ($rs) {
			$rs['nickname'] = base64_decode($rs['nickname']);
			$this->ajaxReturn(array('code'=>6,'msg'=>'核对正确【'.$rs['nickname'].'】','pic'=>$rs['headimgurl']));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'核对失败，会员无此手机号'));
		}
	}
	/*属性编辑获取值*/
	public function getAttrOptionVal(){
		$option_name = I('post.option_name');
		$goods_id = I('post.goods_id');
		$data = explode("_",substr($option_name,1));
		$idStr = "";
		foreach ($data as $k => $v) {
			if ($k) {
				$idStr.= "_".$this->finddata('attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}else{
				$idStr.= $this->finddata('attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}
		}
		$data = $this->finddata('goods_attr_list',array('attr_val'=>$idStr));
		if ($data) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'获取失败'));
		}
	}

	/*属性编辑获取值*/
	public function getGroupGoodsAttrOptionVal(){
		$option_name = I('post.option_name');
		$goods_id = I('post.goods_id');
		$data = explode("_",substr($option_name,1));
		$idStr = "";
		foreach ($data as $k => $v) {
			if ($k) {
				$idStr.= "_".$this->finddata('group_goods_attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}else{
				$idStr.= $this->finddata('group_goods_attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}
		}
		$data = $this->finddata('group_goods_attr_list',array('attr_val'=>$idStr));
		if ($data) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'获取失败'));
		}
	}
}