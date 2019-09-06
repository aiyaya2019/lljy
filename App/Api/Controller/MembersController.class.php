<?php
namespace Api\Controller;
use Think\Controller;
use Think\Vender;
class MembersController extends CommonController {
    // 会员信息添加
    public function addMembers(){
        $request = json_decode(file_get_contents('php://input'),1);
        if(!$request['openid']){
            echo encode(array('code'=>1,'msg'=>'缺少必要参数openid')); return;
        }
        $members = M('members')->where(array('openid'=>$request['openid']))->find();
        $base = M('base')->where(array('id'=>1))->find();
        /* 判断是否开启分销 */
        if($base['agent_status']=='1'){
            $top_id = 0;
        }else{
            $top_id = $request['top_id'] ? $request['top_id']:$base['agent_one_id'];
        }
        $headimgpath = "Uploads/Index/headimg/".$request['openid'].".jpg";
        downimg($request['headimgurl'],$headimgpath); 
        $data = array(
            'headimgurl'    =>  $request['headimgurl'],
            'headimg'       =>  $headimgpath,
            'nickname'      =>  base64_encode($request['nickname']),
            'sex'           =>  $request['sex'],
            'openid'        =>  $request['openid'],
            'city'          =>  $request['city'],
            'province'      =>  $request['province'],
            'create_time'   =>  time(),
            'userphone'     =>  $request['userphone'],
            'username'      =>  $request['username'],
            'top_id'        =>  $top_id,
            'type'          =>  2
        );
        $data = array_filter($data);   /* 过滤掉数组值为空的字段 */
        if($members){
            $members['nickname'] = base64_decode($members['nickname']);
            echo encode(array('code'=>6,'msg'=>'用户已存在','data'=>$members));
            
        }else{
            $members_id = M('members')->add($data);
            if ($members_id) {
                $members = $this->finddata('members',array('id'=>$members_id));
                $members['nickname'] = base64_decode($members['nickname']);
                echo encode(array('code'=>6,'msg'=>'会员数据添加成功','data'=>$members));
            }
        }
    }

    // 编辑会员信息
    public function editMembers(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $formid = $request['formid'];
        if(!$members_id){
            echo encode(array('code'=>1,'msg'=>'缺少必要参数openid')); return;
        }
        if ($formid) {
            $this->addFormId($formid,$members_id);
        }
        $data = array(
            'sex'           =>  $request['sex'],
            'city'          =>  $request['city'],
            'province'      =>  $request['province'],
            'area'          =>  $request['area'],
            'details'       =>  $request['details'],
            'update_time'   =>  time(),
            'userphone'     =>  $request['userphone'],
            'username'      =>  $request['username'],
        );
        $data = array_filter($data);   /* 过滤掉数组值为空的字段 */
        $rs = M('members')->where(array('id'=>$members_id))->save($data);
        if ($rs){
            echo encode(array('code'=>6,'msg'=>'修改成功'));
        }else{
            echo encode(array('code'=>2,'msg'=>'保存失败')); 
        }
        
    }
    
    /* 获取用户的微信信息 */
    public function getMembersInfo(){
       $request = json_decode(file_get_contents('php://input'),1);
       if (!$request['members_id']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
       }
       $data = $this->finddata('members',array('id'=>$request['members_id']));
       $data['nickname'] = base64_decode($data['nickname']);
       if ($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
       }else{
           echo encode(array('code'=>2,'msg'=>'未查询到该会员信息')); 
       }
    }

    /* 个人中心页面初始化Api */
    public function index(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = array();
        $members = M('members')->where(array('id'=>$members_id))->find();
        $members['nickname'] = base64_decode($members['nickname']);
        $where = array('members_id'=>$members_id);
        $members['collect'] = $this->countdata('collect',$where);
        $allnews = $this->countdata('news',array('members_id'=>$members_id,'status'=>0));
        $looknews = $this->countdata('news_search',$where);
        // dump($allnews-$looknews);
        $members['news'] = $allnews-$looknews;
         /* 判断是否分销商 */
        $agent = $this->finddata('agent',array('members_id'=>$members_id));
        if ($agent) {
            if($agent['status']==0){
                $members['is_agent'] = 1;  /* 在审核 */
            }elseif ($agent['status']==1) {
                $members['is_agent'] = 2;   /* 已通过，是分销商 */
            }elseif ($agent['status']==2) {
                $members['is_agent'] = 3;   /* 申请分销商被拒绝 */
            }
        }else{
            $members['is_agent'] = 0;
        }
        $data['members'] =  $members;
        $status0 = $this->countdata('mall_order',array('status'=>0,'members_id'=>$members_id));
        $status1 = $this->countdata('mall_order',array('status'=>1,'members_id'=>$members_id));
        $status2 = $this->countdata('mall_order',array('status'=>2,'members_id'=>$members_id));
        $status3 = $this->countdata('mall_order',array('status'=>3,'members_id'=>$members_id));
        $count = array(
            'status0'=>$status0,
            'status1'=>$status1,
            'status2'=>$status2,
            'status3'=>$status3,
        );
        $data['count'] =  $count;
        if ($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'您没有修改任何信息')); 
        }
    }

     /* 完善修改用户的微信信息 */
    public function membersInfoHandel(){
       $request = json_decode(file_get_contents('php://input'),1);
       if (!$request['members_id']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
       }
       $data = $this->savedata('members',$request,array('id'=>$request['members_id']));
       if ($data){
           echo encode(array('code'=>6,'msg'=>'修改成功','data'=>$data));
       }else{
           echo encode(array('code'=>2,'msg'=>'您没有修改任何信息')); 
       }
    }

    /* 获取默认收货地址 */
    public function getDefaultAddress(){
        $request = json_decode(file_get_contents('php://input'),1);
        if (!$request['members_id']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if ($request['address_id']) {
            $where = array('members_id'=>$request['members_id'],'address_id'=>$request['address_id']);
        }else{
            $where = array('members_id'=>$request['members_id'],'default'=>1);
        }
        $data = $this->finddata('address',$where);
        if ($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'用户未添加地址'));
        }
    }

    /* 获取用户的收货地址列表 */
    public function address(){
        $request = json_decode(file_get_contents('php://input'),1);
        if (!$request['members_id']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = $this->selectdata('address',array('members_id'=>$request['members_id']));
        if ($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'用户未添加地址'));
        }
    }

    /* 传入地址ID，设置默认地址 */
    public function setDefault(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $address_id = $request['address_id'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$address_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数address_id')); return;
        }
        $rs = M('address')->where(array('members_id'=>$members_id))->setField('default',0);
        $rs1 = M('address')->where(array('id'=>$address_id))->setField('default',1);
        if ($rs || $rs1){
           echo encode(array('code'=>6,'msg'=>'设置成功'));
        }else{
           echo encode(array('code'=>2,'msg'=>'设置失败'));
        }
    }

     /* 传入地址ID，获取地址详情 */
    public function address_edit(){
        $request = json_decode(file_get_contents('php://input'),1);
        $address_id = $request['address_id'];
        if (!$address_id) {
           echo encode(array('code'=>6,'msg'=>'添加操作')); return;
        }
        $data = $this->finddata('address',array('id'=>$address_id));
        if ($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'未查到该数据'));
        }
    }

     /* 添加/修改地址数据处理 */
    public function address_editHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $username = $request['username'];
        $userphone = $request['userphone'];
        $province = $request['province'];
        $city = $request['city'];
        $area = $request['area'];
        $details = $request['details'];
        $zipcode = $request['zipcode'];
        $address_id = $request['address_id'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$username) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数username')); return;
        }
        if (!$userphone) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数userphone')); return;
        }
        if (!$province) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数province')); return;
        }
        M('address') ->where(array('members_id'=>$members_id)) ->setField('default', 0);
        $data = array(
           "members_id"=>$members_id,
           "username"=>$username,
           "userphone"=>$userphone,
           "province"=>$province,
           "city"=>$city,
           "area"=>$area,
           "details"=>$details,
           "zipcode"=>$zipcode,
           "default"=>1
        );
        if ($address_id) {
            $rs = $this->savedata('address',$data,array('id'=>$address_id));
            $msg = "修改成功";
        }else{
            $rs = $this->adddata('address',$data);
            $msg = "添加成功";
        }
        if ($rs){
           echo encode(array('code'=>6,'msg'=>$msg));
        }else{
           echo encode(array('code'=>2,'msg'=>'未查到该数据'));
        }
    }

    /* 传入地址ID，地址删除 */
    public function address_del(){
        $request = json_decode(file_get_contents('php://input'),1);
        $address_id = $request['address_id'];
        if (!$address_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数address_id')); return;
        }
        $rs = $this->deletedata('address',array('id'=>$address_id));
        if ($rs){
           echo encode(array('code'=>6,'msg'=>"删除成功"));
        }else{
           echo encode(array('code'=>2,'msg'=>'未查到该数据'));
        }
    }

    /*我的收藏*/
    public function  collect(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = $this->selectdata('collect',array('members_id'=>$members_id));
        foreach ($data as $k => $v) {
            $goods = M('goods')->where(array('id'=>$v['goods_id']))->find();
            $data[$k]['pic'] = $goods['pic'];
            $data[$k]['name'] = $goods['name'];
            $data[$k]['newprice'] = $goods['price'];
            $data[$k]['title'] = $goods['title'];
        }
        if ($data){
            echo encode(array('code'=>6,'msg'=>"获取成功","data"=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'您还没有收藏的商品'));
        }
    }
    
    // 获取订单列表
    public function orderList(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $status = $request['status'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        /* 状态0:未支付，1：已支付待发货，2:已发货待收货，3:已收货待评价，4:已评价已完成，5:已取消、10:表示全部订单 */
        if(isset($status)){
            if ($status!=10) {
                $where['status'] = $status;
            }
            $where['members_id'] = $members_id;
        }else{
            $where['members_id'] = $members_id;
            $where['status'] = array('egt',1);
        }
        $data = D('OrderRelation')->where($where)->order('id desc')->select();
        foreach ($data as $k => $v) {
            $where = array();
            $where['mall_order_id'] = $v['id'];
            $where['create_time'] = array('lt',time()+86400);
            $where['members_id'] = $members_id;
            $rs = M('mall_order_reminder')->where($where)->count();
            $data[$k]['is_reminder'] = intval($rs) ? intval($rs) : 0;
            $list = M('mall_order_list')->where(array('ordercode'=>$v['ordercode']))->select();
            foreach ($list as $key => $val) {
                $goods_attr = json_decode($val['goods_attr'],1);
                $list[$key]['goods_attr'] =$goods_attr ;
            }
            $data[$k]['child'] = $list;
        }
        if ($data){
            echo encode(array('code'=>6,'msg'=>"获取成功","data"=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'您还没有订单'));
        }
    }
    // 订单（取消）or（确认收货）Api
    public function setOrderStatus(){
        $request = json_decode(file_get_contents('php://input'),1);
        $ordercode = $request['ordercode'];
        $status = $request['status'];
        if (!$ordercode) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数ordercode')); return;
        }
        if (!$status) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数status')); return;
        }
        $rs = M('mall_order')->where(array('ordercode'=>$ordercode))->setField('status',$status);
        if ($rs){
            echo encode(array('code'=>6,'msg'=>"设置成功"));
        }else{
            echo encode(array('code'=>2,'msg'=>'设置失败'));
        }
    }

    // 获取订单详情
    public function orderDetails(){
        $request = json_decode(file_get_contents('php://input'),1);
        $ordercode = $request['ordercode'];
        if (!$ordercode) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数ordercode')); return;
        }
        $nopay_valid_time = getBase('nopay_valid_time');
        $data = D('OrderRelation')->relation(true)->where(array('ordercode'=>$ordercode))->find();
        if ($data['coupon_code']){
           $coupon_name = $this->finddata('get_coupon',array('coupon_code'=>$data['coupon_code']),'name');
           $data['coupon_name'] = $coupon_name;
        }
        $where = array();
        $where['mall_order_id'] = $data['id'];
        $where['create_time'] = array('lt',time()+86400);
        $where['members_id'] = $data['members_id'];
        $rs = M('mall_order_reminder')->where($where)->count();
        $data['is_reminder'] = intval($rs) ? intval($rs) : 0;
        $list = $this->selectdata('mall_order_list',array('ordercode'=>$ordercode));
        foreach ($list as $k => $v) {
            $list[$k]['goods_attr'] = json_decode($v['goods_attr'],1);
        }
        $data['child'] = $list;
        $end_time = $data['create_time']+ ($nopay_valid_time*60*60);
        $data['hours_min'] = differenceTime(time(),$end_time);
        if ($data){
            $data['create_time'] = date('Y-m-d H:i',$data['create_time']);
            echo encode(array('code'=>6,'msg'=>"获取成功","data"=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'您还没有订单'));
        }
    }
    
   // 订单删除 
    public function delOrder(){
       $request = json_decode(file_get_contents('php://input'),1);
       $ordercode = $request['ordercode'];
       $rs = $this->deletedata("mall_order",array('ordercode'=>$ordercode));
       if ($rs) {
           echo encode(array('code'=>6,'msg'=>"删除成功"));
       }else{
           echo encode(array('code'=>2,'msg'=>'删除失败'));
       }
    }
    /* 催单功能 */
    public function reminderHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $order_id = $request['order_id'];
        $members_id = $request['members_id'];
        $where = array();
        $where['mall_order_id'] = $order_id;
        $where['create_time'] = array('lt',time()+86400);
        $where['members_id'] = $members_id;
        $rs = M('mall_order_reminder')->where($where)->count();
        if ($rs) {
             echo encode(array('code'=>2,'msg'=>'您已经催过单了'));
        }else{
            $data = array(
              'members_id'=>$members_id,
              'mall_order_id'=>$order_id,
              'create_time'=>time()
            );
            $rs = M('mall_order_reminder')->data($data)->add();
            if ($rs) {
                echo encode(array('code'=>6,'msg'=>'催单成功'));
            }else{
                echo encode(array('code'=>2,'msg'=>'催单失败'));
            }
            
        }
    }
    // 获取已领取的优惠券
    public function getCoupon(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $status = $request['status'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = $this->selectdata('get_coupon',array('members_id'=>$members_id,'status'=>$status));
        foreach ($data as $k => $v) {
          $data[$k]['end_time'] = date("Y-m-d",$v['end_time']);
        }
        if ($data){
            echo encode(array('code'=>6,'msg'=>"获取成功","data"=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'您还没有领取的优惠券'));
        }
    }
    /* 我要反馈数据提交处理 */
    public function msgHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $content = $request['content'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$content) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数content')); return;
        }
        $data = array(
          'content'=>$content,
          'create_time'=>time(),
          'ip'=>get_client_ip(),
          'members_id'=>$members_id
        );
        $rs = M('messages')->data($data)->add();
        if ($rs){
            echo encode(array('code'=>6,'msg'=>"提交成功"));
        }else{
            echo encode(array('code'=>2,'msg'=>'提交失败'));
        }
    }
    /* 我的积分记录 */
    public function point(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = $this->selectdata('point_change',array('members_id'=>$members_id));
        foreach ($data as $k => $v){
           $data[$k]['create_time'] = date('Y-m-d',$v['create_time']);
        }
        if ($data){
            echo encode(array('code'=>6,'msg'=>"获取成功","data"=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'获取失败'));
        }
    }
    /* 申请分销商 */
    public function applyAgentHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $username = $request['username'];
        $userphone = $request['userphone'];
        $idcard = $request['idcard'];
        $province = $request['province'];
        $city = $request['city'];
        $area = $request['area'];
        $details = $request['details'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$username) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数username')); return;
        }
        if (!$userphone) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数userphone')); return;
        }
        if (!$idcard) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数idcard')); return;
        }
        if (!$province) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数province')); return;
        }
        if (!$city) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数city')); return;
        }
        if (!$area) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数area')); return;
        }
        if (!$details) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数details')); return;
        }
        $is_apply = M('agent')->where(array('members_id'=>$members_id))->count();
        if ($is_apply) {
              echo encode(array('code'=>2,'msg'=>'您已经申请过了，请勿重复提交申请')); return;
        }

        $access_token = A("Api/WechatApi")->getAccessToken();
        $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token=".$access_token;
        $data = array("path"=>"pages/index/index?top_id=".$members_id,"width"=>430);
        $result = api_notice_increment($url,json_encode($data));
        $cardcode = "Uploads/Admin/barcode/".$members_id.".jpg";
        $rs = file_put_contents($cardcode,$result);
        $data = array(
            "username"       =>    $username,
            "userphone"      =>    $userphone,
            "idcard"         =>    $idcard,
            "create_time"    =>    time(),
            "members_id"     =>    $members_id,
            "province"       =>    $province,
            "city"           =>    $city,
            "area"           =>    $area,
            "details"        =>    $details,
            "work_code"      =>    randomCode(2,6),
            "cardcode"       =>    $cardcode
        );
        $rs = $this->adddata("agent",$data);
        if ($rs){
            echo encode(array('code'=>6,'msg'=>"申请提交成功"));
        }else{
            echo encode(array('code'=>2,'msg'=>'提交失败'));
        }
    }
    // 获取充值包
    public function getPackage(){
        $data = $this->selectdata('money_package',array('status'=>0));
        if ($data){
            echo encode(array('code'=>6,'msg'=>"获取成功",'data'=>$data));
        }else{
            echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }
    // 获取充值包支付信息
    public function getRechangPay(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $package_id = $request['package_id'];
        $type = $request['type'];
        $money = $request['money'];
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$type) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数type')); return;
        }
        if ($type==1) {       //充值包支付
            if (!$package_id) {
               echo encode(array('code'=>1,'msg'=>'缺少必要参数package_id')); return;
            }
            $data = $this->finddata('money_package',array('id'=>$package_id));
            $paymoney = $data['money'];
        }elseif ($type==2) {   //其他金额支付
            if (!$money) {
               echo encode(array('code'=>1,'msg'=>'缺少必要参数money')); return;
            }
            $paymoney = $money;
        }
        $openid = M('members')->where(array('id'=>$members_id))->getField("openid");
        $ordercode = randomCode();
        $paydata = $this->wxpay('预约支付',$ordercode,$paymoney,$openid);
        echo encode(array('code'=>6,'msg'=>'获取支付数据成功','data'=>$paydata));
    }

    // 余额充值数据处理
    public function rechargeHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $package_id = $request['package_id'];
        $type = $request['type'];
        $money = $request['money'];
         if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        if (!$type) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数type')); return;
        }
        if ($type==1) {       //充值包支付
            if (!$package_id) {
               echo encode(array('code'=>1,'msg'=>'缺少必要参数package_id')); return;
            }
            $package = $this->finddata('money_package',array('id'=>$package_id));
            $paymoney = $package['money'] + $package['send_money'];
        }elseif ($type==2) {   //其他金额支付
            if (!$money) {
               echo encode(array('code'=>1,'msg'=>'缺少必要参数money')); return;
            }
            $paymoney = $money;
            $package = $this->finddata('money_package',array('money'=>$money));
            if ($package) {
                $paymoney = $package['money'] + $package['send_money'];
            }
        }
        $data = array(
            "money"       =>    $paymoney,
            "type"        =>    1,
            "msg"         =>    "余额充值",
            "members_id"  =>    $members_id,
            "create_time" =>    time()
        );
        $rs = $this->adddata('money_change',$data);
        if($rs){
           echo encode(array('code'=>6,'msg'=>'充值成功'));
        }else{
           echo encode(array('code'=>2,'msg'=>'订单添加失败，请稍后重试'));
        }
    }

     // 获取要评论的订单商品信息
    public function orderEvaluate(){
        $request = json_decode(file_get_contents('php://input'),1);
        $ordercode = $request['ordercode'];
        if (!$ordercode) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数ordercode')); return;
        }
        $data = $this->selectdata('mall_order_list',array('ordercode'=>$ordercode));
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'获取失败，请稍后重试'));
        }
    }

    // 评价内容提交
    public function evaluateHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $ordercode = $request['ordercode'];
        $content = $request['content'];
        $star = $request['star'];
        $members_id = $request['members_id'];
        if (!$ordercode) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数ordercode')); return;
        }
        if (!$content) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数content')); return;
        }
        if (!$star) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数star')); return;
        }
        if (!$members_id) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数members_id')); return;
        }
        $data = $this->selectdata('mall_order_list',array('ordercode'=>$ordercode));
        foreach ($data as $k => $v) {
            $arr = array(
                "star"             =>   $star,
                "content"          =>   $content,
                "goods_id"         =>   $v['goods_id'],
                "ordercode"        =>   $ordercode,
                "create_time"      =>   time(),
                "members_id"       =>   $members_id
            );
            $rs = $this->adddata("order_evaluate",$arr);
        }
        if($rs){
           echo encode(array('code'=>6,'msg'=>'提交成功'));
        }else{
           echo encode(array('code'=>2,'msg'=>'获取失败，请稍后重试'));
        }
    }
    // 获取订单详情商品
     public function order_refund(){
        $request = json_decode(file_get_contents('php://input'),1);
        $goods_list_id = $request['goods_list_id'];
        $where = array("id"=>$goods_list_id);
        $data = M("mall_order_list")->where($where)->find();
        if ($data['goods_attr']) {
            $data['goods_attr'] = json_decode($data['goods_attr'],1);
        }
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'获取失败，请稍后重试'));
        }
    }
    public function refundApplyHandel(){
        $request = json_decode(file_get_contents('php://input'),1);
        if (!$request['mall_order_list_id']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数mall_order_list_id')); return;
        }
        if (!$request['is_receipt']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数is_receipt')); return;
        }
        if (!$request['type']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数type')); return;
        }
        if (!$request['result']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数result')); return;
        }
        if (!$request['msg']) {
           echo encode(array('code'=>1,'msg'=>'缺少必要参数msg')); return;
        }
        $request['create_time'] = time();
        sleep(3);
        $request['many_pic'] = json_encode(S($request['members_id']));
        $rs =  $this->adddata('order_refund',$request);
        if($rs){

           echo encode(array('code'=>6,'msg'=>'提交成功'));
        }else{
           echo encode(array('code'=>2,'msg'=>'提交失败，请稍后重试'));
        }
    }


































    /* 自然人-----------异步绑定手机号 */
    public function upinfo_phoneHandel(){
        $session_phone = $_SESSION['msg']['userphone'];
        $userphone = I('post.userphone');
        $session_msgcode = $_SESSION['msg']['msgcode'];
        $msgcode = I('post.msgcode');
        if ($session_msgcode != $msgcode){
            $this->ajaxReturn(array('code'=>'1','msg'=>'验证码错误'));
        }
        $status = M('members')->where(array('id'=>$this->members_id,'userphone'=>$userphone))->count();
        if($status) {
            $this->ajaxReturn(array('code'=>'2','msg'=>'该手机号已经被绑定'));
        }
        if ($session_msgcode == $msgcode && $session_phone == $userphone) {
            $data = array('userphone'=>$userphone);
            if(M("members")->where(array('id'=>$this->members_id))->data($data)->save()){
                $this->ajaxReturn(array('code'=>'6','msg'=>'绑定成功'));
            }else{
                $this->ajaxReturn(array('code'=>'4','msg'=>'绑定失败'));
            }
        }else{
             $this->ajaxReturn(array('code'=>'3','msg'=>'手机号和验证码不符合'));
        }
    }
    /* 订单评价 */
    public function order_evaluate(){
        $ordercode = I('get.ordercode');
        if ($ordercode) {
            $where = array('ordercode'=>$ordercode);
            $data = D('OrderListRelation')->relation(true)->where($where)->select();
            $this->data = $data;
        }
        $this->title = "评价";
        $this->display();
    }

    
}