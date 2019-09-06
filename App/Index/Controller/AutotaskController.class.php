<?php
namespace Index\Controller;
use Think\Controller;
use Think\Vender;

/**
 * 自动任务处理
 */
class AutotaskController extends CommonController {

    /**
     * 优惠券过期，更新优惠券状态
     */
    public function changeCode(){
        // 已经领取的防伪码
        // $code = M('code')->field('id, first_time')->where(['state' => '1'])->select();
        $code = M('code')->field('id, first_time')->where(['mid' => '1'])->select();
        if ($code) {
            $time = time();//当前时间
            // $year = 
            $ids  = [];//过期的防伪码id
            foreach ($code as $key => $value) {
                // if (strtotime('+1years', $value['first_time']) - $time >= '0') {//从第一次使用开始至今超过1年
                    $ids[] = $value['id'];
                // }
            }
            if (!empty($ids)) {
                $ids = implode(',', $ids);
                $res = M('code')->where(['id' => ['in', $ids]])->fetchsql(false)->save(['state' => '3', 'update_time' => time()]);
                if ($res) {
                    echo json_encode(['code' => '6', 'msg' => '操作成功']);
                }else{
                    echo json_encode(['code' => '2', 'msg' => '操作失败']);
                }
            }
        }
    }
    







}