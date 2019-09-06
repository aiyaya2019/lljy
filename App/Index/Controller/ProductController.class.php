<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;

class ProductController extends CommonController {
	/**
     * 产品中心
     * $num_id 可领取次数
     * $limit 页面当前产品数量
     */
    public function index(){
        $num_id = I('get.num_id');
        $limit  = I('get.limit');

        if (IS_POST) {
            $num_id     = I('post.num_id');
            $pro_cateid = I('post.pro_cateid');
            if ($pro_cateid) {
                $where['pro_cateid'] = $pro_cateid;
            }
            if (!$num_id) {
                echo json_decode(['code' => '0', 'msg' => '缺少必需参数num_id']);return;
            }
        }else{
            if (!$num_id) {
                $this->error('缺少必需参数num_id');
            }
        }

        $where['num_id'] = $num_id;
        $where['status'] = '1';

        $limit = $limit ? $limit + '10' : '10';
        $products = M('product')->field('id, name, pic')->where($where)->order('sort asc')->select();
        if (IS_POST) {
            if ($products) {
                echo json_encode(['code' => '1', 'msg' => '获取成功', 'data' => $products]);return;
            }else{
                echo json_encode(['code' => '0', 'msg' => '无数据']);return;
            }
        }

        // 产品类型
        $product_cate = M('product_cate')->field('id, name')->order('sort asc')->select();

        $this->products     = $products;
        $this->product_cate = $product_cate;

    	$this->display();
    }

    /**
     * 产品详情
     * $id 产品id
     */
    public function details(){
        $mid = $this->members_id;
        $id  = I('get.id');

        // $mid = 1;
        if (!$id) {
            $this->error('缺少必需参数id');
        }
        $details = M('product')->where(['id' => $id])->find();
        if ($details) {
            $details['many_pic'] = unserialize($details['many_pic']);
        }
        $address = M('address')->where(['members_id' => $mid, 'default' => '1'])->find();

        $this->details = $details;
        $this->address = $address;
    	$this->display();
    }

    /**
     * 提交订单页
     * $product_id 商品id
     */
    public function confirmOrder(){
        $mid        = $this->members_id;
        $product_id = I('get.product_id');
        $buy_num    = I('get.buy_num');
        $address_id = I('get.address_id');

        // $mid = 1;
        // $address_id = 1;
        if (!$product_id) {
            $this->error('缺少必需参数product_id');
        }
        if (!$buy_num) {
            $this->error('缺少必需参数buy_num');
        }
        if (!$address_id) {
            $this->error('请选择收货地址');
        }
        $product = M('product')->where(['id' => $product_id])->find();
        if ($product) {
            $product['buy_num'] = $buy_num;
            $product['address'] = M('address')->where(['members_id' => $mid, 'default' => '1'])->find();
        }
        $this->product = $product;
    	$this->display();
    }

    /**
     * 支付前检查防伪码
     */
    public function checkCode(){
        $mid        = $this->members_id;
        $product_id = I('get.product_id');
        $buy_num    = I('get.buy_num');
        $code       = I('get.code');
        $freight    = I('get.freight');
        $province   = I('get.province');
        $city       = I('get.city');
        $area       = I('get.area');
        $addr       = I('get.addr');
        $addr_id    = I('get.addr_id');
        $phone      = I('get.phone');

        if (!$mid) {
            echo json_encode(['code' => '0', 'msg' => '缺少必需参数mid']);return;
        }
        if (!$product_id) {
            echo json_encode(['code' => '0', 'msg' => '缺少必需参数product_id']);return;
        }
        if (!$buy_num) {
            echo json_encode(['code' => '0', 'msg' => '缺少必需参数buy_num']);return;
        }
        if (!$code) {
            echo json_encode(['code' => '0', 'msg' => '缺少必需参数code']);return;
        }
        if (!$freight) {
            echo json_encode(['code' => '0', 'msg' => '缺少必需参数freight']);return;
        }
        if (!$addr_id) {
            echo json_encode(['code' => '0', 'msg' => '请选择收货地址']);return;
        }

        $check_code = M('code')->where(['mid' => $mid, 'code' => $code])->find();//使用的防伪码信息
        // print_r($check_code);
        if (!$check_code) {
            echo json_encode(['code' => '0', 'msg' => '您没有领取该防伪码']);return;
        }
        // state  0未领取；1已领取；2已用完；3已过期；4无效
        if ($check_code['state'] != '1') {//防伪码过期或无效（包括用完领取次数）
            echo json_encode(['code' => '0', 'msg' => '该防伪码不可用']);return;
        }

        $product = M('product')->where(['id' => $product_id])->find();//要购买的商品信息

        if ($product['num_id'] != $check_code['number_id']) {
            echo json_encode(['code' => '0', 'msg' => '该防伪码不能领取此商品']);return;
        }

        echo json_encode(['code' => '1', 'msg' => '验证成功']);return;


    }



























    /**
     * 生成订单信息
     * $mid        会员id
     * $buy_num    购买数量
     * $product_id 产品id
     * $code       防伪码
     * $freight    运费
     * 
     * $province 省
     * $city     市
     * $area     区
     * $addr     详细地址
     * $addr_id  收货地址id
     * $phone    收货人号码
     */
    public function addOrder(){
        $mid        = $this->members_id;
        $product_id = I('get.product_id');
        $buy_num    = I('get.buy_num');
        $code       = I('get.code');
        $freight    = I('get.freight');
        $province   = I('get.province');
        $city       = I('get.city');
        $area       = I('get.area');
        $addr       = I('get.addr');
        $addr_id    = I('get.addr_id');
        $phone      = I('get.phone');

        // $mid = 1;

        if (!$mid) {
            $this->error('缺少必需参数mid');
        }
        if (!$product_id) {
            $this->error('缺少必需参数product_id');
        }
        if (!$buy_num) {
            $this->error('缺少必需参数buy_num');
        }
        if (!$code) {
            $this->error('缺少必需参数code');
        }
        if (!$freight) {
            $this->error('缺少必需参数freight');
        }
        if (!$addr_id) {
            $this->error('请选择收货地址');
        }

        $check_code = M('code')->where(['mid' => $mid, 'code' => $code])->find();//使用的防伪码信息
        // print_r($check_code);
        if (!$check_code) {
            $this->error('您没有领取该防伪码');
        }
        // state  0未领取；1已领取；2已用完；3已过期；4无效
        if ($check_code['state'] != '1') {//防伪码过期或无效（包括用完领取次数）
            $this->error('该防伪码不可用');
        }

        $product = M('product')->where(['id' => $product_id])->find();//要购买的商品信息

        if ($product['num_id'] != $check_code['number_id']) {
            $this->error('该防伪码领取次数不等于商品可领取次数');
        }

        // code表更新的信息
        $up_code = [
            'last_time'   => time(),
            'update_time' => time(),
            'num'         => $check_code['num'] - '1',
        ];
        if ($check_code['first_time'] == '0') {
            $up_code['first_time'] = time();
        }
        if (($check_code['num'] - '1') <= '0') {
            $up_code['state'] = '2';//领取次数用完
        }

        // print_r($up_code);exit;

        // 订单信息
        $order = [
            'order_num'    => randomCode(),
            'pay_money'    => $freight,
            'product_id'   => $product_id,
            'product_name' => $product['name'],
            'buy_num'      => $buy_num,
            'code_id'      => $check_code['id'],
            'code'         => $check_code['code'],
            'mid'          => $mid,
            'username'     => M('address')->where(['id' => $addr_id])->getField('username'),
            'freight'      => $freight,
            'phone'        => $phone,
            'province'     => $province,
            'city'         => $city,
            'area'         => $area,
            'addr'         => $addr,
            'addr_id'      => $addr_id,
            'zipcode'      => M('address')->where(['id' => $addr_id])->getField('zipcode'),
            'create_time'  => time(),
        ];

        M()->startTrans();//启动事务

        $res_upcode  = M('code')->where(['mid' => $mid, 'code' => $code])->save($up_code);//更新code表
        $res_order   = M('order')->add($order);//添加订单信息
        $res_product = M('product')->where(['id' => $product_id])->setDec('stock');//商品库存减1

        if (($res_upcode && $res_order && $res_product)) {
            M()->commit();//提交事务


            $_SESSION['pay']['url'] = array(
                'addordesUrl'=>U('Product/payOrder'),
                'successUrl'=>U('Me/order'),
                'returnUrl'=>U('Me/order'),
            );
            $_SESSION['pay']['data'] = array(
                'table'=>'order',
                'order_num'=>$order['order_num'],
                'money'=>$order['pay_money'],
                'title'=>'订单支付',
            );

            $this->redirect('Pay/wxpay');
        }else{
            M()->rollback();//事务回滚
        }

    }

    /* 支付成功之后 */
    public function payOrder(){
        if ($_SESSION["pay"]["data"]["order_num"] && $this->members_id) {
            $data = array(
                'status'      => 1,
                "pay_type"    => 1,
                'pay_time'    => time(),
                'update_time' => time()
            );
            $where = array('order_num'=>$_SESSION["pay"]["data"]["order_num"]);
            $rs = M("order")->where($where)->data($data)->save();
            if ($rs) {
                 // $this->ajaxReturn(array('code'=>6,'msg'=>'订单添加成功'));
                echo json_encode(array('code'=>6,'msg'=>'订单添加成功'));
            }else{
                echo json_encode(array('code'=>2,'msg'=>'失败'));
            }
        }
    }

    public function address(){
        $mid = $this->members_id;
        // $mid = 1;
        $this->data = $this->selectdata('address',array('members_id'=>$mid));
        $this->display();
    }
    public function address_edit(){
        $mid = $this->members_id;
        // $mid = 1;
        $id =I('get.id');
        if ($id) {
           $this->data = $this->finddata('address',array('id'=>$id,'members_id'=> $mid));
        }
        $this->display();
    }





}