<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class AjaxController extends CommonController {
    public function __construct(){
        parent::__construct();
        if(!IS_AJAX) E('非法操作');
    }
    /* 异步收藏 */
    public function collect(){
      	$goods_id = I('post.goods_id');
      	$type = I('post.type');
      	$members_id = $this->members_id;
      	if ($type =='del') {
      		$rs = M('collect')->where(array('members_id'=>$members_id,'goods_id'=>$goods_id))->delete();
      	}else if($type =='add') {
      		$arr = array('members_id'=>$members_id,'goods_id'=>$goods_id);
      		$rs = M('collect')->add($arr);
      	}
      	if ($rs){
      		$this->ajaxReturn(array('code'=>6,'msg'=>'成功'));
      	}else{
      		$this->ajaxReturn(array('code'=>1,'msg'=>'操作失败'));
      	}
    }
    /* 添加单条数据
     * @param string $table 添加的表名
     * @param array $data 插入的数据
     * @return methid 结果方法
     */
    public function adddata($table='',$data=''){
        if ($id = M($table)->add($data)) {
            return $id;
        }else{
            return false;
        }
    }
    /* 修改单条数据
     * @param string $table 修改的表名
     * @param array $data 修改的数据
     * @return methid 结果方法
     */
    public function savedata($table='',$data='',$where){
        if ($id = M($table)->where($where)->data($data)->save()) {
            return $id;
        }else{
            return false;
        }
    }
    /*保存支付数据*/
    public function savePay(){
       $goods_id = I('post.goods_id');
       $goods = M('goods')->field('price,savenum')->where(array('id'=>$goods_id))->find();
       if ($goods['price']<1) {
          $this->ajaxReturn(array('code'=>1,'msg'=>'支付金额不能小于1元'));
       }
       if ($goods['savenum']<1) {
          $this->ajaxReturn(array('code'=>2,'msg'=>'库存不足，请联系店主补仓'));
       }
       $ordercode = randomCode();
       $_SESSION['pay']['url'] = array(
            'addordesUrl'=>U('Mall/addOrder'),
            'successUrl'=>U('Status/successPay'),
            'returnUrl'=>U('Mall/details',array('id'=>$goods_id)),
        );
       $_SESSION['pay']['data'] = array(
            'table'=>'mall_order',
            'ordercode'=>$ordercode,
            'money'=>$goods['price'],
            'title'=>'商品支付',
            'num'=>1,
            'goods_id'=>$goods_id,
            'type'=>1
        );
        $this->ajaxReturn(array('code'=>6,'msg'=>'存储成功'));
    }
    public function msgHandel(){
     $data = array(
          'content'=>I('post.content'),
          'create_time'=>time(),
          'ip'=>get_client_ip(),
          'members_id'=>$this->members_id
        );
        $rs = M('messages')->data($data)->add();
        if ($rs) {
           $this->ajaxReturn(array('code'=>6,'msg'=>'反馈信息提交成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'提交失败'));
        }
    }
     //短信发送$mobile:发送手机号 $totalnum:充值额度 $surplusnum：剩余额度
    public function SendMsg(){
        $phone = I('post.phone');
        header('Content-type: text/html; charset=utf-8');
        $base = M('base')->field('msg_account,msg_secret,msg_url,msg_sign')->find();
        $password = md5($base['msg_account'].md5($base['msg_secret']));
        $rand =  rand(100000,900000);
        $_SESSION['msg'] = array("msgcode"=>$rand,'userphone'=>$phone);
        $content = "尊敬的用户您好，您的验证码为：".$rand."，5分钟有效【".$base['msg_sign']."】";
        $data = "username=".$base['msg_account']."&password=".$password."&mobile=".$phone."&content=".$content;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $base['msg_url']);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        if ($output>0) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'发送成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>$output));
        }
    }
    /*添加购物车*/
    public function addCart(){
        $goods_id = I('post.goods_id');
        $goods_name = I('post.goods_name');
        $goods_pic = I('post.goods_pic');
        $goods_price = I('post.goods_price');
        $num = I('post.num',0,'intval');
        $goods_attr = I("post.attr_val");
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        $cart->addItem($goods_id,$goods_name,$goods_price,$num,$goods_pic,$goods_attr);       
        $this->ajaxReturn(array('code'=>6,'msg'=>'操作成功','data'=>$data));
    }
    /*设置默认地址*/
    public function setDdefaultAdd(){
        $id = I('post.id');
        $rs = M('address')->where(array('members_id'=>$this->members_id,'default'=>1))->setField('default',0);
        $rs1 = M('address')->where(array('members_id'=>$this->members_id,'id'=>$id))->setField('default',1);
        if($rs && $rs1) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'设置成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'设置失败'));
        }
    }
    
    /* 添加到购物车 */
    public function buyOrder(){
        $type = I('get.type');
        $data = I('post.');
        if ($type==1) {   //直接购买
            $attr_str = "";
            foreach ($data['attr'] as $k => $v){
                if ($k) {
                    $attr_str .= ",".$v['id'];
                }else{
                   $attr_str .= $v['id'];
                }
            }
            $data['attr_str'] = $attr_str;
            unset($_SESSION['buy']);
            $_SESSION['buy'][] = $data;
            // dump($_SESSION['buy']);
            // die;
        }else{             //购物车选中购买
            import('Class.Cart',APP_PATH);
            $cart = new \Cart();
            $cartGoods =  $cart->getCartItem($data['data']);
            $_SESSION['buy'] = $cartGoods;
        }
        $this->ajaxReturn(array('code'=>6,'msg'=>'购买数据保存成功'));
    }
    /* 添加、修改用户收货地址
     * @return JSON
     */
    public function address_editHandel(){
        $data = I('post.');
        $address = I('post.address');
        $arr = explode(',',$address);
        $data['province'] = $arr[0];
        $data['city'] = $arr[1];
        $data['area'] = $arr[2];
        $data['members_id'] = $this->members_id;
        if ($id = I('get.id')) {
            $rs = $this->savedata('address',$data,array('id'=>$id));
        }else{
            M('address')->where(array('members_id'=>$this->members_id))->setField('default',0);
            $data['default'] = 1;
            $rs = $this->adddata('address',$data);
        }
        if ($rs) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'操作成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'操作失败'));
        }
    }
    /* 修改购物车商品数量
     * @param string $goods_id 商品ID
     * @param string $type 操作类型，add、jian
     * @return methid 无返回
     */
    public function updateNum(){
        $goods_id = I('post.goods_id');
        $type = I('post.type');
        $attr_str = I('post.attr_str');
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        if ($type=="add") {
            $cart->incNum($goods_id,1,$attr_str);
        }else{
            $cart->decNum($goods_id,1,$attr_str);
        }
    }
     /* 删除购物车商品
     * @param string $goods_id 商品ID
     * @return methid 无返回
     */
    public function delNum(){
        $goods_id = I('post.goods_id');
        $attr_str = I('post.attr_str');
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        $cart->delItem($goods_id,$attr_str);
    }
    public function getCartNum(){
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        $data = $cart->getNum();
        $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
    }
    public function getAllPrice(){
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        $getAllPrice = $cart->getAllPrice();
        $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','price'=>$getAllPrice));
    }
    /* 获取价格 */
    public function getPrice(){
        $data = I('post.data');
        import('Class.Cart',APP_PATH);
        $cart = new \Cart();
        $getPrice = $cart->getPrice($data);
        $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','price'=>$getPrice));
    }
    /* 修改订单状态 */
    public function upField(){
        $order_id = I('post.order_id');
        $status = I('post.status');
        $rs = M('mall_order')->where(array('id'=>$order_id))->setField('status',$status);
        if ($rs) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'操作成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'操作失败'));
        }
    }
    /* 删除订单 */
    public function delorder(){
        $order_id = I('post.order_id');
        $rs = $this->deletedata('mall_order',array('id'=>$order_id));
        if ($rs) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'删除成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'删除失败'));
        }
    }
    /*写入支付订单session*/
    public function payWrite(){
        $order_id = I('post.order_id');
        $data = $this->finddata('mall_order',array('id'=>$order_id));
        if ($data) {
           $_SESSION['pay']['url'] = array(
              'addordesUrl'=>U('Mall/payOrder'),
              'successUrl'=>U('Status/status',array('type'=>1)),
              'returnUrl'=>U('Members/order',array('status'=>1)),
           );
           $_SESSION['pay']['data'] = array(
              'table'=>'mall_order',
              'ordercode'=>$data['ordercode'],
              'money'=>$data['paymoney'],
              'title'=>'订单支付',
           );
           $this->ajaxReturn(array('code'=>6,'msg'=>'写入成功'));
        }else{
           $this->ajaxReturn(array('code'=>1,'msg'=>'无此订单'));
        }
    }
    /* 异步催单 */
    public function reminder(){
        $order_id = I('post.order_id');
        $where = array();
        $where['mall_order_id'] = $order_id;
        $where['create_time'] = array('lt',time()+86400);
        $where['members_id'] = $this->members_id;
        $rs = M('mall_order_reminder')->where($where)->count();
        if ($rs) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'您已经催过单了'));
        }else{
            $data = array(
              'members_id'=>$this->members_id,
              'mall_order_id'=>$order_id,
              'create_time'=>time()
            );
            M('mall_order_reminder')->data($data)->add();
            $this->ajaxReturn(array('code'=>1,'msg'=>'催单成功'));
        }
    }
    /* 产看快递单号 */
    public function logistics(){
       $order_id = I('post.order_id');
       $logistics =M('mall_order')->field('logistics_id,logistics_code')->where(array('id'=>$order_id))->find();
       $logistics_name = $this->finddata('logistics',array('id'=>$logistics['logistics_id']),'name');
       if ($logistics) {
         $logistics = array(
            'logistics_name'=>$logistics_name,
            'logistics_code'=>$logistics['logistics_code']
         );
         $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$logistics));
       }else{
          $this->ajaxReturn(array('code'=>1,'msg'=>'暂无快递单号'));
       }
    }
    /* 获取一级分类下的二级分离 */
    public function getCate(){
       $cate_id = I('post.cate_id');
       $data = M('goods_cate')->where(array('pid'=>$cate_id,'status'=>0))->order('sort ASC')->select();
       foreach ($data as $k => $v) {
        $cate = M('goods_cate')->where(array('pid'=>$v['id'],'status'=>0))->order('sort ASC')->select();
           $data[$k]['child'] = $cate;
       }
       if ($data) {
         $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
       }else{
          $this->ajaxReturn(array('code'=>1,'msg'=>'没有分类'));
       }
    }
    public function is_buyCart(){
       $buydata = $_SESSION['buy'];
       if($buydata){
           $this->ajaxReturn(array('code'=>6,'msg'=>'有商品'));
       }else{
           $this->ajaxReturn(array('code'=>1,'msg'=>'没有商品'));
       }
    }
    // 判断是否有评论
    public function is_evaluate(){
       $ordercode = I('post.ordercode');
       if($ordercode){
          $rs = $this->countdata('order_evaluate',array('ordercode'=>$ordercode));
          if($rs){
              $this->ajaxReturn(array('code'=>6,'msg'=>'有评价'));
          }else{
              $this->ajaxReturn(array('code'=>1,'msg'=>'无评价'));
          }
       }else{
          $this->ajaxReturn(array('code'=>1,'msg'=>'无评价'));
       }
    }
    /* 属性排序 */
    public function getAttr(){
        $goods_id = I('post.goods_id');
        $data = D('AttrCateRelation')->relation(true)->where(array('goods_id'=>$goods_id))->order('id ASC')->select();
        foreach ($data as $key => $row) {
           $volume[$key]  = $row['id'];
           $edition[$key] = count($row['attr_option']);
        }
        /* 双数组合并排序 */
        array_multisort($edition, SORT_ASC,$volume, SORT_ASC, $data);
        $newdata = $data;
        if ($newdata){
            $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$newdata));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'没有属性'));
        }
    }
    public function getAttrval(){
        $goods_id = I('post.goods_id');
        $attr_val = I('post.attr_val');
        $data = $this->finddata('goods_attr_list',array('goods_id'=>$goods_id,'attr_val'=>$attr_val));
        if ($data){
            $this->ajaxReturn(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'没有库存了'));
        }
    }
    // 领取优惠券
    public function getCoupon(){
        $members_id = $this->members_id;
        $coupon_id = I('post.coupon_id');
        $from = I('post.from');
        if($members_id && $coupon_id){
            $where = array(
               "members_id"=>$members_id,
               "status"=>0,
               "coupon_id"=>$coupon_id
            );
            $is_have = M("get_coupon")->where($where)->count();
            if($is_have){
              $this->ajaxReturn(array('code'=>2,'msg'=>'您已经领取过了'));
            }
            $coupon = M('coupon')->where(array('id'=>$coupon_id))->find();
            $time = time();
            $end_time = $time+($coupon['end_day']*86400);
            $coupon_code = randomCode(2,8);
            $ip = get_client_ip();
            $data = array(
                'price'=>$coupon['price'],
                'full_price'=>$coupon['full_price'],
                'end_time'=>$end_time,
                'get_time'=>$time,
                'members_id'=>$members_id,
                'coupon_id'=>$coupon_id,
                'name'=>$coupon['name'],
                'coupon_code'=>$coupon_code,
                'ip'=>$ip,
                'from'=>$from
            );
            $rs = M('get_coupon')->data($data)->add();
            if($rs){
                $this->ajaxReturn(array('code'=>6,'msg'=>'领取成功'));
            }else{
                $this->ajaxReturn(array('code'=>3,'msg'=>'领取失败，请稍后重试'));
            }
          }else{
             $this->ajaxReturn(array('code'=>1,'msg'=>'缺少必要信息'));
        }
    }
    public function moneyHandel(){
        $money_id = I('post.money_id');
        $data = $this->finddata('money_package',array('id'=>$money_id,'status'=>0));
        $_SESSION['pay']['url'] = array(
            'addordesUrl' => U('Members/rechargeHandel'),
            'successUrl'  => U('Status/status',array('type'=>1)),
            'returnUrl'   => U('Members/index'),
        );
        $_SESSION['pay']['data'] = array(
            'table'       =>  'money_recharge',
            'ordercode'   =>  $ordercode,
            'money'       =>  $data['money'],
            'send_money'  =>  $data['send_money'],
            'title'       =>  '订单支付',
        );
        if ($_SESSION['pay']['url'] && $_SESSION['pay']['data']) {
            $this->ajaxReturn(array('code'=>6,'msg'=>'支付成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'网络有点小问题'));
        }
    }

    /* 退款数据处理 */
    public function order_refundHandel(){
        $data = I('post.');
        $data['create_time'] = time();
        $many_pic = array();
        foreach ($data['many_pic'] as $key=>&$vo) {
          $many_pic[] = htmlspecialchars_decode($vo);
        }
        $data['many_pic'] = json_encode($many_pic);        
        $is_have = M("order_refund")->where(array('mall_order_list_id'=>$data['mall_order_list_id']))->count();
        if ($is_have) {
           $this->ajaxReturn(array('code'=>1,'msg'=>'您已经申请过了'));
        }
        $rs = $this->adddata('order_refund',$data);
        if($rs){
            M("mall_order_list")->where(array('id'=>$data['mall_order_list_id']))->setField('refund_status',1);
            $this->ajaxReturn(array('code'=>6,'msg'=>'提交成功'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'提交失败，请稍后重试'));
        }
    }
}