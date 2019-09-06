<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class CommonController extends Controller {
    public $Wechat;
    public $members_id;
    Public function _initialize(){
        if(!isset($_SESSION['wechat']['openid'])){
            $Wechat = new WechatApiController();
            $Wechat->get_wechat_info();
        }
        $this->members_id = $_SESSION['wechat']['id'];
        // $this->members_id =1;
    }
    /*获取配置数据*/
    public function getConfig($field=null){
        if ($field) {
            $result = M('base')->where(array('id'=>1))->getField($field);
        }else{
            $result = M('base')->where(array('id'=>1))->find();
        }
        return $result;
    }
    /**
     * 获取微信分享数据包
     * @param string $place 传入一个位置数字
     * @return 微信分享数据包
     */
     public function share($place){
        $share = M('share')->where(array('place'=>$place))->find();
        // dump($share['pic']);
        $Wechat = new WechatApiController();
        $url = $share['url'] ? $share['url'] : "http://".$_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"].$_SERVER['REDIRECT_URL'];
        $nickname = $_SESSION['wechat']['nickname'];
        $name = str_replace("*", $nickname,$share['name']);
        $title = str_replace("*", $nickname,$share['title']);
        $pic = $share['pic'] ? $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$share['pic'] : $_SESSION['wechat']['headimgurl'];
        $sharedata = $Wechat->wechat_share($url,$pic,$name,$title);
        // dump($sharedata);
        return $sharedata;
    }
    /* 普通分享数据包 */
    public function sharePackage($pic,$name,$title){
        $Wechat = new WechatApiController();
        $url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER["REDIRECT_URL"];
        $pic = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$pic;
        $sharedata = $Wechat->wechat_share($url,$pic,$name,$title);
        // dump($sharedata);
        return $sharedata;
    }
    /**
     * 支付使用
     * @param string $table 支付订单表
     * @param string $title 支付描述
     * @param string $price 支付金额
     * @param string $ordercode 订单编号
     * @return 微信支付的所需字符串
     */
    public function weixinPay($table,$title,$price,$ordercode){
        Vendor('Wxpay.WxPayJsApiPay');
        $tools = new \JsApiPay();
        // $money = '1';
        $money = $price*100;
        //①、获取用户openid
        $openId = $_SESSION['wechat']['openid'];
        if(C('URL_MODEL') ==2){
            $backUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/Index/Product/success.html";
        }else{
            $backUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/Index/Product/success.html";
        }
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody($title);
        $attach = '{"table":"'.$table.'","members_id":"'.$this->members_id.'","ordercode":"'.$ordercode.'"}';
        $input->SetAttach($attach);           //设置回调数据所需要的值
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($money);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($title);
        $input->SetNotify_url($backUrl);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);


        // print_r(\WxPayConfig::MCHID);
        // echo "<br>";
        // print_r(\WxPayConfig::APPID);
        // echo "<br>";
        // print_r(\WxPayConfig::KEY);
        // echo "<br>";
        // print_r(\WxPayConfig::APPSECRET);exit;


        $jsApiParameters = $tools->GetJsApiParameters($order);
        return $jsApiParameters;
    }
    public function apiSendMsg($members_id,$title,$content,$linkurl){
        $url = C('url')."/Api/WxSend/apisendMsg";
        $param = array(
            'id'=>$members_id,
            'title'=>$title,
            'content'=>$content,
            'url'=>C('url').$linkurl
        );
        Api_Request($url,json_encode($param),'POST');
    }
    //获取对应位置banner图
    public function getBanner($place){
        $banner = M('banner')->where(array('status'=>0,'place'=>$place))->order('sort DESC')->select();
        return $banner;
    }
    /* 添加单条数据
     * @param string $table 查询的表名
     * @param array $data 插入的数据
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function adddata($table='',$data=''){
        if ($id= M($table)->add($data)) {
           return $id;
        }else{
           return false;
        }
    }
   /* 查询单条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @return array 查询的结果集
     */
    public function finddata($table='',$where='',$field=''){
        if ($field){
            $data = M($table)->field($field)->where($where)->getField($field);
        }else{
            $data = M($table)->where($where)->find();
        }
        return $data;
    }
    /* 查询多条数据
     * @param string $table 查询的表名
     * @param array $where 查询的where条件，
     * @param string $field 要查询的字段
     * @param string $order 排序
     * @return array 查询的结果集
     */
    public function selectdata($table='',$where='',$field='',$order='id DESC'){
        $data = M($table)->field($field)->order($order)->where($where)->select();
        return $data;
    }
    /* 保存修改数据
     * @param string $table 查询的表名
     * @param array $data 查询的where条件，
     * @param string $url 插入成功后跳转的页面
     * @return methid 结果方法
     */
    public function deletedata($table='',$where=''){
        if(M($table)->where($where)->delete()) {
            return true;
        }else{
            return false;
        }
    }
    /* 统计数据
     * @param string $table 数据表名
     * @param array $data 查询的where条件，
     * @return data 数量
     */
    public function countdata($table='',$where='',$field=null){
        $data = M($table)->where($where)->count($field);
        return $data;
    }
}