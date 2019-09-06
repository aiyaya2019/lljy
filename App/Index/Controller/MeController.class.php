<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class MeController extends CommonController {
	/**
     * 我的首页
     * $id 会员id
     */
    public function index(){
        $id = $this->members_id;
        // $id = 2;
        if (!$id) {
            $this->error('缺少必需参数id');
        }
        $member = M('members')->field('id, headimgurl, nickname')->where(['id' => $id])->find();
        $this->member = $member;
    	$this->display();
    }

    /**
     * 添加防伪码
     * $mid 会员id
     * $code 防伪码
     */
    public function addCode(){
        if (IS_POST) {
            $mid  = $this->members_id;
            $code = I('post.code');
            // $mid = 1;

            if (!$mid) {
                echo json_encode(['status' => '0', 'msg' => '缺少必需参数mid']);return;
            }
            if (!$code) {
                echo json_encode(['status' => '0', 'msg' => '请输入防伪码']);return;
            }

            $where['code']   = $code;
            $where['status'] = '1';
            // $where['state']  = '0';
            // state 0未领取；1已领取；2已用完；3已过期；4无效
            $check = M('code')->where($where)->find();
            if (!$check) {
                echo json_encode(['status' => '0', 'msg' => '该防伪码不存在或无效']);return;
            }elseif ($check['state'] == '1' || $check['state'] == '2') {
                echo json_encode(['status' => '0', 'msg' => '该防伪码已被领取']);return;
            }elseif ($check['state'] == '3' || $check['state'] == '4') {
                echo json_encode(['status' => '0', 'msg' => '该防伪码已过期或无效']);return;
            }else{

                $res = M('code')->where(['code' => $code])->save(['mid' => $mid, 'state' => '1', 'get_time' => time()]);
                if ($res) {
                    echo json_encode(['status' => '1', 'msg' => '领取成功']);return;
                }else{
                    echo json_encode(['status' => '0', 'msg' => '领取失败']);return;
                }
            }
        }else{
            $this->display();
        }
        
    }

    /**
     * 全部防伪码/已过期防伪码
     * $mid   会员id
     * $state 防伪码状态：0未使用；1已使用未过期；2已过期；3无效
     * $limit 页面当前防伪码数量
     */
    public function code(){
        $mid   = $this->members_id;
        $state = I('get.state');
        // $mid = 1;

        if (!$mid) {
            $this->error('缺少必需参数mid');
        }
        if ($state !== null) {
            if ($state == 'yes') {
                $where['state'] = ['in','0,1'];
            }elseif ($state == 'no') {
                $where['state'] = ['in','2,3'];
            }
            $where['mid'] = $mid;
        }else{
            $where['mid'] = $mid;
        }
        $code = M('code')->where($where)->order('get_time desc')->select();
        if ($code) {
            $number = M('number')->field('id,num')->where(['status' => '1'])->select();
            $number = array_column($number, null, 'id');

            foreach ($code as $key => &$value) {
                $code[$key]['all_num']  = $number[$value['number_id']]['num'];
                $code[$key]['get_time'] = date('Y-m-d', $value['get_time']);
            }
            // echo json_encode(['status' => '1', 'msg' => '获取成功']);return;
        }else{
            // echo json_encode(['status' => '0', 'msg' => '获取失败']);return;
        }
        $this->code = $code;


        $this->display();
    }

    /**
     * 领取记录
     * $mid   会员id
     */
    public function record(){
        $mid   = $this->members_id;
        // $mid = 1;
        if (!$mid) {
            $this->error('缺少必需参数mid');
        }
        $data = M('order')->where(['mid' => $mid])->order('create_time desc')->select();
        if ($data) {

            $code = M('code')->field('id, code, num, number_id')->where(['mid' => $mid])->select();
            if ($code) {
                $number = M('number')->field('id,num')->where(['status' => '1'])->select();
                $number = array_column($number, null, 'id');//领取次数
                foreach ($code as $key => &$value) {
                    $code[$key]['all_num'] = $number[$value['number_id']]['num'];
                }
            }
            $code = array_column($code, null, 'id');

            foreach ($data as $k => &$val) {
                $data[$k]['all_num']     = $code[$val['code_id']]['all_num'];
                $data[$k]['num']     = $code[$val['code_id']]['num'];
                $data[$k]['create_time'] = date('Y-m-d', $val['create_time']);
            }
        }

        $this->record = $data;
        $this->display();
    }

    /**
     * 可领取次数
     * $mid   会员id
     */
    public function number(){
        $mid   = $this->members_id;
        // $mid = 1;
        if (!$mid) {
            $this->error('缺少必需参数mid');
        }

        $where['state'] = ['in','0,1'];
        $where['mid']   = $mid;
        $code = M('code')->field('id, code, num, number_id')->where($where)->order('get_time desc')->select();
        if ($code) {
            $number = M('number')->field('id,num')->where(['status' => '1'])->select();
            $number = array_column($number, null, 'id');
            foreach ($code as $key => &$value) {
                $code[$key]['all_num'] = $number[$value['number_id']]['num'];
            }
        }

        $this->code = $code;
        $this->display();
    }

    /**
     * 我的订单
     * $mid    会员id
     * $limit  页面当前订单数量
     * $status 订单状态：0未支付，1已支付待发货，2已发货待收货，3已收货;4关闭
     */
    public function order(){
        $mid    = $this->members_id;
        $status = I('get.status');
        // $mid = 1;
        if (!$mid) {
            $this->error('缺少必需参数mid');
        }
        if ($status != '') {
            $where['o.status'] = $status;
        }
        if (IS_POST) {
            $status = I('post.status');
            if ($status != '') {
                $where['o.status'] = $status;
            }
        }
        $where['o.mid'] = $mid;
        $field = 'o.id, o.order_num, o.buy_num, o.status, o.freight, p.name, p.pic';
        $order = M("order as o")
            ->join('tbkl_product as p on o.product_id = p.id')
            ->field($field)
            ->where($where)
            ->order('o.id desc')
            ->select();
            // echo M()->getLastSql();exit;
        if ($order) {
            foreach ($order as $key => &$value) {
                switch($value['status']){
                    case '0':
                        $order[$key]['status_name'] = '未支付';
                        break;
                    case '1':
                        $order[$key]['status_name'] = '已支付待发货';
                        break;
                    case '2':
                        $order[$key]['status_name'] = '已发货待收货';
                        break;
                    case '3':
                        $order[$key]['status_name'] = '已收货';
                        break;
                    default:
                        $order[$key]['status_name'] = '关闭';
                }
            }
            if (IS_POST) {
                echo json_encode(['code' => '1', 'msg' => '获取成功', 'data' => $order]);return;
            }else{
                $this->order = $order;
            }
        }else{
            if (IS_POST) {
                echo json_encode(['code' => '0', 'msg' => '无信息']);return;
            }else{
                $this->order = $order;
            }
        }
        
        $this->display();
    }

    /**
     * 我的订单详情
     * $order_id 订单id
     */
    public function orderInfo(){
        $order_id = I('get.order_id');
        if (!$order_id) {
            $this->error('缺少必需参数order_id');
        }

        $where['o.id'] = $order_id;
        $field = 'o.id, o.order_num, o.buy_num, o.pay_money, o.status, o.freight, o.province, o.city, o.area, o.addr, o.code, o.username, o.phone, o.create_time, o.freight, p.name, p.pic';
        $details = M("order as o")
            ->join('tbkl_product as p on o.product_id = p.id')
            ->field($field)
            ->where($where)
            ->order('o.id desc')
            ->find();

        $this->details = $details;
        $this->display();
    }

    /**
     * 确认收货
     * $order_id 订单id
     */
    public function confirmOrder(){
        $mid      = $this->members_id;
        $order_id = I('get.order_id');
        // $mid = 1;

        if (!$order_id) {
            $this->error('缺少必需参数order_id');
        }
        if (!$mid) {
            $this->error('缺少必需参数mid');
        }
        $res = M('order')->where(['id' => $order_id])->save(['status' => '3', 'update_time' => time()]);
        if ($res) {
            $this->success('成功收货', '/Index/Me/order?mid=' .$mid);
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

    /* 自然人-----------更新地址 */
    public function upfield_info_address(){
        if (!IS_AJAX) E('非法请求');
        $address = I('post.address');
        $arr = explode(',',$address);
        $data = array(
            'province'=>$arr[0],
            'city'=>$arr[1],
            'area'=>$arr[2],
            'update_time'=>time()
        );
        $rs = M('members')->where(array('id'=>$this->members_id))->save($data);
        if($rs){
            $this->ajaxReturn(array('code'=>6,'msg'=>'success'));
        }else{
            $this->ajaxReturn(array('code'=>1,'msg'=>'error'));
        }
    }






}