<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;
class LoginController extends CommonController {
	/**
     * 防伪码手机号登陆
     */
    // public function login(){
    //     if (IS_POST) {
    //         $mid   = $this->members_id;
    //         $phone = I('post.phone');
    //         $code  = I('post.code');

    //         // $mid = 2;
    //         if (!$mid) {
    //             echo json_encode(['status' => '0', 'msg' => '缺少必需参数mid']);return;
    //         }
    //         if (!$phone) {
    //             echo json_encode(['status' => '0', 'msg' => '请输入手机号']);return;
    //         }
    //         if (!$code) {
    //             echo json_encode(['status' => '0', 'msg' => '请输入防伪码']);return;
    //         }
    //         $where['code']   = $code;
    //         $where['status'] = '1';
    //         // state 0未领取；1已领取；2已用完；3已过期；4无效
    //         $check = M('code')->where($where)->find();
    //         if (!$check) {
    //             echo json_encode(['status' => '0', 'msg' => '该防伪码不存在或无效']);return;
    //         }elseif ($check['state'] == '1' || $check['state'] == '2') {
    //             echo json_encode(['status' => '0', 'msg' => '该防伪码已被领取']);return;
    //         }elseif ($check['state'] == '3' || $check['state'] == '4') {
    //             echo json_encode(['status' => '0', 'msg' => '该防伪码已过期或无效']);return;
    //         }

    //         M()->startTrans();//启动事务

    //         // 更新防伪码表
    //         $res_code = M('code')->where(['code' => $code])->save(['mid' => $mid, 'phone' => $phone, 'state' => '1', 'update_time' => time()]);
    //         // 更新会员表手机号
    //         $res_members = M('members')->where(['id' => $mid])->save(['userphone' => $phone, 'update_time' => time()]);

    //         if ($res_code && $res_members) {
    //             M()->commit();//提交事务

    //             $wxdata = M('members')->where(['id' => $mid])->find();
    //             $wxdata['nickname'] = base64_decode($wxdata['nickname']);
    //             $_SESSION['wechat'] = $wxdata;
    //             S('wechat', $wxdata);

    //             echo json_encode(['status' => '1', 'msg' => '登陆成功']);return;
    //         }else{
    //             M()->rollback();//事务回滚
    //             echo json_encode(['status' => '0', 'msg' => '登陆失败']);return;
    //         }

    //     }else{
    //         $this->display();
    //     }
    // }


    /**
     * 防伪码手机号登陆
     */
    public function login(){
        if (IS_POST) {
            $mid   = $this->members_id;
            $phone = I('post.phone');
            $code  = I('post.code');

            // $mid = 2;
            if (!$mid) {
                echo json_encode(['status' => '0', 'msg' => '缺少必需参数mid']);return;
            }
            if (!$phone) {
                echo json_encode(['status' => '0', 'msg' => '请输入手机号']);return;
            }
            if (!$code) {
                echo json_encode(['status' => '0', 'msg' => '请输入防伪码']);return;
            }

            $members = M('members')->where(['id' => $mid])->find();

            $where['code']   = $code;
            $where['status'] = '1';
            // state 0未领取；1已领取；2已用完；3已过期；4无效
            $check = M('code')->where($where)->find();
            if (!$check) {
                echo json_encode(['status' => '0', 'msg' => '该防伪码不存在或无效']);return;
            }elseif ($check['state'] == '3' || $check['state'] == '4') {
                echo json_encode(['status' => '0', 'msg' => '该防伪码已过期或无效']);return;
            }elseif ($check['state'] == '1' || $check['state'] == '2') {
                if ($code == $check['code'] && $phone == $check['phone']) {
                    if ($mid != $check['mid']) {
                        echo json_encode(['status' => '0', 'msg' => '登陆失败，该账号不是您的']);return;
                    }else{
                        echo json_encode(['status' => '1', 'msg' => '登陆成功']);return;
                    }
                    
                }else{
                    echo json_encode(['status' => '0', 'msg' => '登陆失败，该防伪码已被绑定']);return;
                }
            }else{//未领取

                M()->startTrans();//启动事务

                // 更新防伪码表
                $res_code = M('code')->where(['code' => $code])->save(['mid' => $mid, 'phone' => $phone, 'state' => '1', 'update_time' => time()]);
                // 更新会员表手机号
                $res_members = M('members')->where(['id' => $mid])->save(['userphone' => $phone, 'update_time' => time()]);

                if ($res_code && $res_members) {
                    M()->commit();//提交事务

                    $wxdata = M('members')->where(['id' => $mid])->find();
                    $wxdata['nickname'] = base64_decode($wxdata['nickname']);
                    $_SESSION['wechat'] = $wxdata;
                    S('wechat', $wxdata);

                    echo json_encode(['status' => '1', 'msg' => '登陆成功']);return;
                }else{
                    M()->rollback();//事务回滚
                    echo json_encode(['status' => '0', 'msg' => '登陆失败']);return;
                }
            }

        }else{
            $this->display();
        }
    }


    /**
     * 退出登陆
     */
    public function loginout(){
        $mid = $this->members_id;
        // S('wechat',null);
        $_SESSION['wechat'] = '';
        $this->redirect('WechatApi/get_wechat_info');
    }









}