<?php
namespace Api\Controller;
use Think\Controller;
class  AdminController extends CommonController {
    // 登录数据处理
    Public function loginHandel(){
        $request = json_decode(file_get_contents("php://input"),1);
        $name = $request['name'];
        $password = $request['password'];
        if (!$name) {
            echo encode(array('code'=>1,'msg'=>'请输入管理员账号')); return false;
        }
        if (!$password) {
            echo encode(array('code'=>1,'msg'=>'请输入管理员密码')); return false;
        }
        $password = md5($password);
        $admin = $this->finddata("admin",array('name'=>$name,'password'=>$password));
        if ($admin) {
            if ($admin['status']==1) {
                echo encode(array('code'=>2,'msg'=>'账号被锁定，请联系管理员'));
            }else{
                echo encode(array('code'=>6,'msg'=>'登录成功','data'=>$admin));
            }
        }else{
           echo encode(array('code'=>2,'msg'=>'账号或密码错误'));
        }
    }

    // 获取会员列表
    public function getMembers(){
        $request = json_decode(file_get_contents("php://input"),1);
        $keywords = $request['keywords'];
        $page = $request['page']? $request['page']:1;
        if ($keywords) {
            $nickname = base64_encode($keywords);
            $where = "username like '%$keywords%' or userphone like '%$keywords%' or nickname='$nickname'";
        }
        $data = M("members")->where($where)->field($field)->order("id desc")->page($page,10)->select();
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:i',$v['create_time']);
            $data[$k]['nickname'] = base64_decode($v['nickname']);
        }
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }

    // 获取会员详情
    public function getMembersDetails(){
        $request = json_decode(file_get_contents("php://input"),1);
        $members_id = $request['members_id'];
        if ($members_id) {
            $where = "id=$members_id";
        }
        $data = M("members")->where($where)->find();
        $data['create_time'] = date('Y-m-d H:i',$v['create_time']);
        $data['nickname'] = base64_decode($v['nickname']);
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }

    // 获取用户反馈列表
    public function getMembersMsg(){
        $request = json_decode(file_get_contents("php://input"),1);
        $keywords = $request['keywords'];
        $page = $request['page']? $request['page']:1;
        if ($keywords) {
            $nickname = base64_encode($keywords);
            $where = "username like '%$keywords%' or userphone like '%$keywords%' or nickname='$nickname' or content like '%$keywords%'";
        }
        $data = M("messages")->where($where)->field($field)->order("id desc")->page($page,10)->select();
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:i',$v['create_time']);
            $data[$k]['nickname'] = base64_decode($v['nickname']);
        }
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }

    // 获取代理商
    public function getAgent(){
        $request = json_decode(file_get_contents("php://input"),1);
        $keywords = $request['keywords'];
        $page = $request['page'] ? $request['page']:1;
        if ($keywords) {
            $nickname = base64_encode($keywords);
            $where = "username like '%$keywords%' or userphone like '%$keywords%'";
        }
        $data = D("AgentRelation")->relation(true)->where($where)->field($field)->order("id desc")->page($page,10)->select();
        foreach ($data as $k => $v) {
            $data[$k]['create_time'] = date('Y-m-d H:i',$v['create_time']);
            $data[$k]['nickname'] = base64_decode($v['nickname']);
        }
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }

     // 获取代理商详情
    public function getAgentDetails(){
        $request = json_decode(file_get_contents("php://input"),1);
        $agent_id = $request['agent_id'];
        if (!$agent_id) {
             echo encode(array('code'=>1,'msg'=>'缺少必要参数agent_id')); return false;
        }
        $data = D("AgentRelation")->relation(true)->where(array('id'=>$agent_id))->find();
        $data['create_time'] = date('Y-m-d H:i',$data['create_time']);
        $data['nickname'] = base64_decode($data['nickname']);
        if($data){
           echo encode(array('code'=>6,'msg'=>'获取成功','data'=>$data));
        }else{
           echo encode(array('code'=>2,'msg'=>'暂无数据'));
        }
    }
    
}