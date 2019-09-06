<?php
namespace Admin\Controller;
use Think\Controller;
class RushMallController extends CommonController {
	// 商品列表
	public function goods(){
		$pagedata = $this->Page('point_goods',C('page'));  //$table为分页表名，$num分页显示数据返回limit值和分页样式
		$data=M('rush_goods')->limit($pagedata['limit'])->order('sort DESC')->select();
		// dump($_SERVER);
		$this->page=$pagedata['page'];
		$this->data = $data;
		$this->display();
	}
	// 商品添加和编辑
	public function goods_edit(){
		$id = I('get.id');
		if ($id) {
			$data=M('rush_goods')->where(array('id'=>$id))->find();
			$this->data=$data;
			$this->many_pic = json_decode($data['many_pic']);
		}
		$this->display();
	}
	// 商品添加和编辑数据处理
	public function goods_editHandle(){
		if(!IS_POST) E('页面不存在');
		$id = I('get.id');
		$data = I('post.');
		$start_time = I('post.start_time');
		$end_time = I('post.end_time');
		$data['start_time'] = strtotime($start_time);
		$data['end_time'] = strtotime($end_time);
		$data['content']= I('post.content','','htmlspecialchars_decode');
		$data['many_pic'] = json_encode($data['many_pic']);
		if(!$id){
			$data['create_time'] = time();
			if($goods_id = M('rush_goods')->add($data)){
				$this->success('添加成功！！！',U('RushMall/goods'));
			}else{
				$this->error('添加失败！！！');
			}
		}else{
			$data['update_time']=time();
			if(M('rush_goods')->where(array('id'=>$id))->data($data)->save()){
				$this->success('保存成功！！！',U('RushMall/goods'));
			}else{
				$this->error('保存失败！！！');
			}
		}
	}
    // 商品删除操作
	public function goods_delete(){
		$id = I('post.id');
		$rs = $this->deletedata('rush_goods',array('id'=>$id));
		if ($rs) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'删除失败，可能少主键id'));
		}
	}
	public function addAttrCate($goods_id,$data){
		M("rush_attr_cate")->where(array('goods_id'=>$goods_id))->delete();
		M("rush_attr_option")->where(array('goods_id'=>$goods_id))->delete();
		foreach ($data['attr_cate_name'] as $k => $v){
			/* 插入属性分类信息 */
			$attrCate = array('goods_id'=>$goods_id,'name'=>$v);
			$attr_cate_id = M('rush_attr_cate')->data($attrCate)->add();
			/* 规格项目 */
			foreach ($data['attr_option_name_'.$v] as $key => $value) {
				$attrOption = array('attr_cate_id'=>$attr_cate_id,'name'=>$value,'goods_id'=>$goods_id);
			    $rs = M('rush_attr_option')->data($attrOption)->add();
			}
		}
		return $rs;
	}
	/* 保存规格表单处理 */
	public function attrHandel(){
		$data = I('post.');
		$goods_id = $data['goods_id'];
		foreach($data as $key=>$val){
			$value[] = preg_replace('# #','',$val);
			if(!is_array($val)){
				$keys[] = strtr($key,['$d'=>'.']);
			}else{
				$keys[] = $key;
			}
		}
		$data = array_combine($keys,$value);
		//$this->ajaxReturn(array('code'=>1,'msg'=>'保存规格失败','data'=>$data));
		/* 插入属性类别名称 */
		$attr_cate = $data['attr_cate_name'];
		$AttrCate = $this->addAttrCate($goods_id,$data);
		/* 添加属性值 */
		foreach ($attr_cate as $key => $value) {
			 $data = bykeyarr($data,"attr_option_name_".$value);
		}
		$data = bykeyarr($data,"attr_cate_name");
		$data = bykeyarr($data,"goods_id");
		//$this->ajaxReturn(array('code'=>1,'msg'=>'保存规格失败','data'=>$data));
		$optionList = $this->getAttrOptionList($goods_id,$data);
		if ($optionList && $AttrCate) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'保存规格成功'));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'保存规格失败'));
		}
	}
	public function getoptionid($goods_id,$data){
		$arr = explode('_',$data);
		$str = "";
		$arr = bykeyarr($arr,0);
		foreach ($arr as $k => $v) {
			$id = M('rush_attr_option')->where(array('goods_id'=>$goods_id,'name'=>$v))->getField('id');
			if ($k) {
				$str.="_".$id;
			}else{
				$str.=$id;
			}
		}
		return $str;
	}
	/* 新增商品属性数据 */
	public function getAttrOptionList($goods_id,$data){
		M("rush_goods_attr_list")->where(array('goods_id'=>$goods_id))->delete();
		$option = array_chunk($data,3);
		$optionIdArr = array();
		foreach ($data as $k => $v) {
			$optionIdArr[] = $this->getoptionid($goods_id,$k);
		}
		
		$a = array_chunk($optionIdArr,3);
		$attrval = array();
		foreach ($a as $k => $v) {
			$attrval[$k][] = $v[0];
		}
		$newArr = array();
		foreach($attrval as $k=>$r){
		    $newArr[] = array_merge($r,$option[$k]);
		}
		foreach ($newArr as $key => $value) {
			$arr = array('attr_val'=>$value[0],'savenum'=>$value[1],'newprice'=>$value[2],'oldprice'=>$value[3],'goods_id'=>$goods_id);
			$rs = M("rush_goods_attr_list")->data($arr)->add();
		}
		return $rs;
	}
	public function goods_attr(){
		$goods_id = I('get.id');
		$attr_cate = $this->selectdata('rush_attr_cate',array('goods_id'=>$goods_id),'','id ASC');
		foreach ($attr_cate as $k => $v){
			$attr_cate[$k]['attr_option'] = $this->selectdata('rush_attr_option',array('goods_id'=>$goods_id,'attr_cate_id'=>$v['id']));
		}
		// dump($attr_cate);
		$this->attr_cate = $attr_cate;
		// $data = $this->getAttrList($goods_id);
		// dump($data);
		$this->display();
	}
	/* 获取属性 */
	public function getAttrList($goods_id){
		$attr_list = $this->selectdata('rush_goods_attr_list',array('goods_id'=>$goods_id));
		foreach ($attr_list as $k => $v) {
			$arr = explode("_", $v['attr_val']);
			foreach($arr as $key => $value){
				$option = M('rush_attr_option')->where(array('id'=>$value))->find();
				$attr_cate_name =  M('rush_attr_cate')->where(array('id'=>$option['attr_cate_id']))->getField("name");
				$attr_list[$k][$attr_cate_name] = $option['name'];
			}
		}
		return $attr_list;
	}
	/*属性编辑获取值*/
	public function getAttrOptionVal(){
		$option_name = I('post.option_name');
		$goods_id = I('post.goods_id');
		$data = explode("_",substr($option_name,1));
		$idStr = "";
		foreach ($data as $k => $v) {
			if ($k) {
				$idStr.= "_".$this->finddata('rush_attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}else{
				$idStr.= $this->finddata('rush_attr_option',array('goods_id'=>$goods_id,'name'=>$v),"id");
			}
		}
		$data = $this->finddata('rush_goods_attr_list',array('attr_val'=>$idStr));
		if ($data) {
			$this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
		}else{
			$this->ajaxReturn(array('code'=>1,'msg'=>'获取失败'));
		}
	}


    // 订单视图
	public function order(){
		$status = $_GET['status'];
		$key = I('get.key');
		if (isset($status)) {  //判断是有效还是无效订单
			$where['status'] = $status;
		}
		if ($key) {
			$where['ordercode'] =  array('like', '%'.$key.'%');
		}
		$pagedata = $this->page('rush_order',C('page'),$where);
		$data= D('RushOrderRelation')->relation(true)->where($where)->order('id desc')->limit($pagedata['limit'])->select();
		$down= D('RushOrderRelation')->relation(true)->where($where)->order('id desc')->select();
		S('rush_order',$down,300);
		// dump($data);
		// die;
		$this->page = $this->$pagedata['page'];
		$this->data=$data;
		$this->display();
	}
	// 订单和编辑view
	public function order_edit(){
		$id = I('get.id');
		if ($id) {
			$data= D('RushOrderRelation')->relation(true)->where(array('id'=>$id))->find();
			$data['attr'] = json_decode($data['attr'],1);
			// dump($data);
		    $this->data=$data;
		    /* 分配快递方式 */
		    $logistics = $this->selectdata('logistics',array('status'=>0));
		    $this->logistics = $logistics;
		}
		$this->display();
	}
	/* 订单数据保存 */
	public function order_editHandle(){
		$id = I('get.id');
		$data = I('post.');
		if ($id) {
			$data['update_time'] = time();
			if(M('rush_order')->where(array('id'=>$id))->data($data)->save()){
				$this->success('保存成功！！！',U('RushMall/order'));
			}else{
				$this->error('保存失败！！！');
			}
		}
	}
	/* 异步发货 */
	public function order_logistics(){
		$order_id = I('post.order_id');
		$data = I('post.');
		$data['status'] = 2;
		$rs = M('rush_order')->where(array('id'=>$order_id))->save($data);
		if ($rs) {
			$wechat = A("Index/WechatApi");
			$mall_order = $this->finddata('rush_order',array('id'=>$order_id));
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
	// 导出订单记录
	public function orderDown(){
		$data = S('rush_order');
		if(!$data){
			$data = D('RushOrderRelation')->relation(true)->order('id desc')->select();
		} 
		// dump($data);die;
		$arr = array(
			array("订单编号","商品编号","商品名称","购买数量","购买规格","支付金额","会员昵称","买家姓名","联系电话","收货省","收货市","收货区","收货详情","订单备注","订单状态","快递名称","快递单号","创建时间")
		);
		// ,"支付金额","物流状态","物流公司","物流编号" //表头名称
		foreach ($data as $k => $v) {
			$arr[$k+1]["ordercode"] = "\t".$v["ordercode"];
			$arr[$k+1]["goods_code"] = "\t".$v["goods_code"];
			$arr[$k+1]["goods_name"] = $v["goods_name"];
			$arr[$k+1]["num"] = $v["num"];
			$attr = json_decode($v['attr'],1);
			$attrStr = "";
			foreach ($attr as $key => $val) {
				if ($key) {
					$attrStr .= ",".$val['name'];
				}else{
					$attrStr .= $val['name'];
				}
			}
			$arr[$k+1]["goods_attr"] = $attrStr? $attrStr:"无规格";
			$arr[$k+1]["new_price"] = $v["new_price"];
			$arr[$k+1]["nickname"] = base64_decode($v["nickname"]);
			$arr[$k+1]["username"] = $v["username"];
			$arr[$k+1]["userphone"] = $v["userphone"];
			$arr[$k+1]["province"] = $v["province"];
			$arr[$k+1]["city"] = $v["city"];
			$arr[$k+1]["area"] = $v["area"];
			$arr[$k+1]["details"] = $v["details"];
			$arr[$k+1]["messages"] = $v["messages"] ? $v["messages"] : "未留言";
			if ($v['status'] ==1) {
				$status = "已支付未发货";
			}else if($v['status'] == 2){
				$status = "已发货待收货";
			}else if($v['status'] == 3){
				$status = "已收货已完成";
			}else{
				$status = "已完成";
			}
			$arr[$k+1]["status"] = $status;
			$arr[$k+1]["logistics_name"] = $v['logistics']['name']?$v['logistics']['name']:"未发货";
			$arr[$k+1]["logistics_code"] = $v['logistics_code']? $v['logistics_code']:"未发货";
			$arr[$k+1]["create_time"] = date('Y-m-d H:i:s', $v["create_time"]);
		}
		$this->Down($arr,"抢购商城--订单");
	}
}
?>