<?php
namespace Api\Controller;
use Think\Controller;
use Think\Vender;
class CallbackController extends Controller {
    public function writeLog($data,$attach_data){
        $paydata = array_merge($data,$attach_data);
        M("paylog")->data($paydata)->add();
    }
    public function dd(){
        dump(S('t'));
        dump(S('t1'));
    }
    public function wxpayback(){
        header("Content-Type: text/html;charset=utf-8"); 
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if (!$xml) {
           echo "非法操作"; return;
        }
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $attach_data = json_decode($data['attach'],true);

        $this->writeLog($data,$attach_data);
        if($data['result_code'] == 'SUCCESS'){
            $members_id      = $attach_data['members_id'];
            $ordercode       = $attach_data['ordercode'];
            $table           = $attach_data['table'];
            if($table == "mall_order"){
                $info = array(
                    'status'=>1,
                    'pay_time'=>time()
                );
                $rs = M("mall_order")->where(array('members_id'=>$members_id,'ordercode'=>$ordercode))->data($info)->save();
                if ($rs) {
                    $is_have = M('money_change')->where("msg like '%".$ordercode."%'")->count();
                    if ($is_have) {
                        echo "SUCCESS";
                    }else{
                        $this->agentSale($ordercode);
                        echo "SUCCESS";
                    }
                   
                }
            }
        }
    }
    // 小程序回调
    public function smpayback(){
        // date_default_timezone_set("PRC");
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        
        if (empty($xml)) $xml = file_get_contents("php://input");
        if ($this->filter) $xml = $this->filter->inputFilter($xml);

        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
   
        if($data['result_code'] == 'SUCCESS'){
            $ordercode = $data['out_trade_no'];
            $order = M('order')->where(['ordercode' => $ordercode])->find();
            $info = array(
                'id'       => $order['id'],
                'status'   => 1,
                'pay_time' => time()
            );//更新订单表

            $buyinfo = [
                'members_id'  => $order['members_id'],
                'type'        => $order['type'],
                'is_pay'      => '1',
                'create_time' => time(),
            ];

            $check_buy_vip = M('buyinfo')->where(['members_id' => $order['members_id'], 'type' => '1'])->find();
            if ($order['type'] == '1') {
                if ($check_buy_vip) {//已经购买过vip
                    if (time() > $check_buy_vip['expire_time']) {//vip已过期
                        $buyinfo['pro_id'] = $order['vip_id'];
                        $buyinfo['term']   = M('vip')->where(['id' => $order['vip_id']])->getField('term');
                        $buyinfo['expire_time'] = strtotime( "+".$buyinfo['term']." month", $info['pay_time']);
                        $buyinfo['create_time'] = time();
                        $buyinfo['update_time'] = '1';

                    }else{//vip未过期
                        $term = M('vip')->where(['id' => $order['vip_id']])->getField('term');
                        $buyinfo['pro_id'] = $order['vip_id'];
                        $buyinfo['term']   = $term + $check_buy_vip['term'];
                        $buyinfo['expire_time'] = $check_buy_vip['expire_time'] + ($term * 30*24*3600);
                        $buyinfo['update_time'] = time();
                    }
                }else{//还没买过vip
                    $buyinfo['pro_id'] = $order['vip_id'];
                    $buyinfo['term']   = M('vip')->where(['id' => $order['vip_id']])->getField('term');
                    $buyinfo['expire_time'] = strtotime( "+".$buyinfo['term']." month", $info['pay_time']);
                }

            }else{
                $buyinfo['pro_id'] = $order['video_id'];
            }

            M()->startTrans();//启动事务
            if ($check_buy_vip) {
                if (!$order['status']) {
                    $res = M('buyinfo')->where(['members_id' => $check_buy_vip['members_id']])->save($buyinfo);
                }else{
                    $res = '1';
                }
                
            }else{
                $res = M('buyinfo')->add($buyinfo);
            }
            
            $rs = M("order")->save($info);
            if ($res && $rs) {
                M()->commit();//提交事务
                $this->agentSale($ordercode);
                echo "SUCCESS";
            }else{
                M()->rollback();//事务回滚
            }
        }
    }
    /* 查询单条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的单个字段
     * @return array 查询的结果集
     */
    public function finddata($table='',$where='',$field=''){
        if($field){
            $data = M($table)->where($where)->getField($field);
            return $data;
        }else{
            $data = M($table)->where($where)->find();
            return $data;
        }
    }
    /* 判断是否分销商
     * @param string $members_id 判断的会员id
     * @return array 如果是则返回分销商信息，如果不是，则返回false
     */
    public function is_agent($members_id){
        $agent = M('agent')->where(array('members_id'=>$members_id))->find();
        if($agent){
            return $agent;
        }else{
            return false;
        }
    }
    /* 返佣操作
     * @param string $ordercode 订单编号
     * @return array 返佣结果
     */
    public function agentSale($ordercode=''){
        header("Content-Type: text/html;charset=utf-8"); 
        // $ordercode = '0rdl2p0t29w824qsh47x';
        $base = M('base')->where(array('id'=>1))->find();
        $order = M('mall_order')->where(array('ordercode'=>$ordercode))->find();
        $nickname = M('members')->where(array('id'=>$order['members_id']))->getField('nickname');
        $text = "订单编号：".$ordercode;
        $text .= "\n支付时间：".date('Y年m月d日 H:i');
        $text .= "\n发货状态：待发货";
        $text .= "\n支付金额：".$order['paymoney'];
        $text .= "\n会员昵称：".base64_decode($nickname);
        $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].U('Admin/Index/index');
        $postdata = array(
            "members_id" => getBase('admin_members_id'),
            "title" => "您有新订单了!!!",
            "content" => $text,
            "url" => $url
        );
        Api_Request(C('SEND_MSG_URL'),json_encode($postdata),"POST");
        if ($base['agent_status']==1){
            return false;   //分销关闭
        }
        $one_top_id = M('members')->where(array('id'=>$order['members_id']))->getField('top_id');
        if ($one_top_id) {      /* 一级分销商返佣 */
            $rs1 = $this->giveAgentMoney($order['ordercode'],$one_top_id,$base['agent_one'],$order['paymoney']);
            if ($rs1) {         /* 二级分销商返佣 */
                $two_top_id = M('members')->where(array('id'=>$one_top_id))->getField('top_id');
                $rs2 = $this->giveAgentMoney($order['ordercode'],$two_top_id,$base['agent_two'],$order['paymoney']);
                if ($rs2) {     /* 三级分销商返佣 */
                    $three_top_id = M('members')->where(array('id'=>$two_top_id))->getField('top_id');
                    $rs3 = $this->giveAgentMoney($order['ordercode'],$three_top_id,$base['agent_three'],$order['paymoney']);
                    if ($rs3) {
                        return true;
                    }else{
                        return false;   
                    }
                }else{
                     return false;   
                }
            }else{
                 return false;   
            }
        }else{
             return false;   
        }
    }
    /* 用户返佣
     * @param string $ordercode 订单号
     * @param string $top_id 返佣人的用户id
     * @param string $scale 返佣的概率，分销商级别不同，概率不同，目前支持三级分销
     * @param string $paymoney 用户的支付金额
     * @return rs 返回状态
     */
    public function giveAgentMoney($ordercode,$top_id,$scale,$paymoney){
        $agent = M('agent')->where(array('members_id'=>$top_id))->find();
        /* 扫二维码得佣金 */
        if (!$agent) {
           return false;   //没有分销
        }
        if ($agent) {
            $scale = ($scale/100);
            $commission = sprintf("%.2f", $paymoney * $scale);
            $commission_change = array(
               'msg'=>'该订单【'.$ordercode.'】分销返佣',
               'members_id'=>$top_id,
               'type'=>1,
               'create_time'=>time(),
               'commission'=>$commission,
            );
            $result = M('commission_change')->data($commission_change)->add();
            return $result;
        }else{
            return false;
        }
    }
    public function test(){
         session_unset();
        session_destroy();
    }
}