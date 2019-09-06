<?php
namespace Api\Controller;
use Think\Controller;

/**
 * 我的控制器--小程序
 */
class MeController extends CommonController {
	public function __construct(){
	}

	/**
	 * 会员信息
	 */
	public function members_info(){
		$request    = json_decode(file_get_contents('php://input'),1);
		$members_id = $request['members_id'];

    // $members_id = 3;

    // $members_info = [
    //   'id' => '1',
    //   'nickname' => '阿斯蒂芬',
    //   'headimgurl' => 'https://wx.qlogo.cn/mmopen/vi_32/akLjhhFGRhYJSJ7XELq4h46crHUhODibcQz1evn2YU7Gib6Hcwc3shlZYo1saLuWjSliaFL4WgWzF1RTy7AD7qvpg/132',
    //   'is_vip' => '1',
    //   'start_time' => date('Y-m-d', '1556695038'),
    //   'end_time' => date('Y-m-d', '1560151038'),
    //   'percent' => round((time()- '1556695038') / ('1560151038' - '1556695038')),
    // ];
    // echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $members_info]);return;

		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少必要参数members_id']);return;
		}
		$members_info = M('members')->field('id, nickname, headimgurl, is_vip')->where(['id' => $members_id])->find();
		if ($members_info) {
      $members_info['nickname'] = base64_decode($members_info['nickname']);

      $where = ['members_id' => $members_id, 'type' => '1', 'is_pay' => '1'];
      $vip_info  = M('buyinfo')->where($where)->order('id desc')->find();
      if ($vip_info) {
        if ($vip_info['expire_time'] >= time()) {
          $members_info['is_vip'] = '1';
          $members_info['start_time'] = date('Y-m-d', $vip_info['create_time']);//vip开通时间
          $members_info['end_time']   = date('Y-m-d', $vip_info['expire_time']);//vip到期时间

          $all_time = $vip_info['expire_time'] - $vip_info['create_time'];//vip总时长 秒
          $use_time = time() - $vip_info['create_time'];//vip已使用时长 秒
          $members_info['percent'] = round($use_time / $all_time);//vip使用时间占比

        }else{
          $members_info['is_vip'] = '0';
        }
      }else{
        $members_info['is_vip'] = '0';
      }
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $members_info]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '获取失败']);
		}
	}

  /**
   * 我的预约
   * $members_id 会员id
   */
  public function my_apply(){
    $request    = json_decode(file_get_contents('php://input'), 1);
    $members_id = $request['members_id'];
    // $members_id = 1;
    if (!$members_id) {
      echo json_encode(['status' => '0', 'msg' => '缺少必要参数members_id']);return;
    }
    $my_apply = M('apply')->where(['members_id' => $members_id, 'status' => '1', 'flag' => '1'])->find();
    if ($my_apply) {
      $my_apply['create_time'] = date('Y-m-d', $my_apply['create_time']);
      echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $my_apply]);
    }else{
      echo json_encode(['status' => '0', 'msg' => '还没申请预约']);
    }
  }

  /**
   * 我的订单
   * $members_id 会员id
   * $type       订单类型：0购买视频(普通);1购买vip
   * $page      页码
   */
  public function my_order(){
    $request    = json_decode(file_get_contents('php://input'), 1);
    $members_id = $request['members_id'];
    $page       = $request['page'] ? $request['page'] : '1';
    $type       = $request['type'] ? $request['type'] : '0';
    // $members_id = 3;
    // $type       = '1';
    if (!$members_id) {
      echo json_encode(['status' => '0', 'msg' => '缺少必要参数members_id']);
    }

    $where['o.members_id'] = ['eq', $members_id];
    if ($type !== null) {
      $where['o.type'] = ['eq', $type];
    }

    // $field = ('o.id, o.ordercode, o.members_id, o.vip_id, o.vip_name, o.video_id, o.pay_money, o.type, o.pay_time, o.create_time, v.title, v.pic, v.video, v.price, v.show_time, v.is_pay, v.is_red, v.look, v.collect, v.buy_num');
    // $my_order = M('order as o')
    //   ->join('tbkl_video as v on o.video_id = v.id')
    //   ->field($field)
    //   ->where($where)
    //   ->order('o.id')
    //   ->limit($limit)
    //   ->fetchsql(false)
    //   ->select();
      
    $field = ('o.id, o.ordercode, o.members_id, o.vip_id, o.video_id, o.pay_money, o.type, o.pay_time, o.status, o.create_time, i.vip_name, i.vip_price, i.cate_id, i.cate_name, i.title, i.pic, i.video, i.video_price, i.show_time, i.desp, i.content, v.look, v.collect, v.buy_num');
    $my_order = M('order as o')
      ->join('tbkl_order_info as i on o.ordercode = i.ordercode', 'left')
      ->join('tbkl_video as v on o.video_id = v.id', 'left')
      ->field($field)
      ->where($where)
      ->order('id desc')
      ->page($page, '10')
      ->select();

      // echo '<pre>';
      // print_r($my_order);exit;

      if ($my_order) {
        $vip_ids = [];
        $collect_video = $this->collect_video(['members_id' => $members_id]);//收藏的视频
        if ($collect_video) {
          $collect_video = array_column($collect_video, 'video_id', 'video_id');
          foreach ($my_order as $key => &$value) {
            $my_order[$key]['pay_time']    = date('Y-m-d', $value['pay_time']);
            $my_order[$key]['create_time'] = date('Y-m-d', $value['create_time']);
            $my_order[$key]['show_time']   = date('Y-m-d', $value['show_time']);
            if (in_array($value['id'], $collect_video)) {
              $my_order[$key]['is_collect'] = '1';//某用户已收藏该视频
            }else{
              $my_order[$key]['is_collect'] = '0';//某用户还没收藏该视频
            }
            if ($value['type'] == '1') {
              $vip_ids[] = $value['vip_id'];
            }
          }
        }else{
          foreach ($my_order as $key => &$value) {
            $my_order[$key]['pay_time']    = date('Y-m-d', $value['pay_time']);
            $my_order[$key]['create_time'] = date('Y-m-d', $value['create_time']);
            $my_order[$key]['show_time']   = date('Y-m-d', $value['show_time']);
            $my_order[$key]['is_collect']  = '0';//某用户还没收藏该视频
            if ($value['type'] == '1') {
              $vip_ids[] = $value['vip_id'];
            }
          }
        }

        if (!empty($vip_ids)) {
          $vip_ids = implode(',', $vip_ids);
          $wh_p['pro_id'] = ['in', $vip_ids];
          $vip_buyed = M('buyinfo')->where($wh_p)->where(['members_id' => $members_id, 'type' => '1'])->select();
          $vip_buyed = array_column($vip_buyed, null, 'pro_id');
          foreach ($my_order as $k => &$v) {
            if ($v['type'] == '1') {
              $v['expire_time'] = date('Y-m-d', $vip_buyed[$v['vip_id']]['expire_time']);
            }
          }
        }
        echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $my_order]);
      }else{
        echo json_encode(['status' => '0', 'msg' => '抱歉 您还没下过订单哦！']);
      }

  }

  /**
   * 观看历史
   * $members_id 会员id
   * $page      页码
   */
  public function my_look(){
    $request    = json_decode(file_get_contents('php://input'), 1);
    $members_id = $request['members_id'];
    $page       = $request['page'] ? $request['page'] : '1';
    // $members_id = 1;
    if (!$members_id) {
      echo json_encode(['status' => '0', 'msg' => '缺少必要参数members_id']);return;
    }
    $where = ['l.members_id' => $members_id];
    $field = ('l.id, l.num, l.look_time, l.video_id, v.title, v.pic, v.video, v.price, v.show_time, v.desp, v.is_pay, v.look, v.collect, v.buy_num');
    $my_look = M('video_look as l')->join('tbkl_video as v on l.video_id = v.id')->field($field)->where($where)->order('l.id desc')->page($page, '10')->select();
    if ($my_look) {
      $collect_video = $this->collect_video(['members_id' => $members_id]);//收藏的视频
      if ($collect_video) {
        $collect_video = array_column($collect_video, 'video_id', 'video_id');
        foreach ($my_look as $key => &$value) {
          $my_look[$key]['look_time'] = date('Y-m-d', $value['look_time']);
          $my_look[$key]['show_time'] = date('Y-m-d', $value['show_time']);
          if (!$value['is_pay']) {
            $value['price'] = '免费';
          }
          if (in_array($value['id'], $collect_video)) {
            $my_look[$key]['is_collect'] = '1';//某用户已收藏该视频
          }else{
            $my_look[$key]['is_collect'] = '0';//某用户还没收藏该视频
          }
        }
      }else{
        foreach ($my_look as $key => &$value) {
          $my_look[$key]['look_time']  = date('Y-m-d', $value['look_time']);
          $my_look[$key]['show_time']  = date('Y-m-d', $value['show_time']);
          $my_look[$key]['is_collect'] = '0';//某用户还没收藏该视频
          if (!$value['is_pay']) {
            $value['price'] = '免费';
          }
        }
      }
      echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $my_look]);
    }else{
      echo json_encode(['status' => '0', 'msg' => '抱歉 您还没观看过视频哦！']);
    }
  }


	/**
	 * 意见反馈
	 * $members_id 会员id
	 * $content    反馈内容
	 * $contact    联系方式
	 */
    public function msg_handel(){
        $request = json_decode(file_get_contents('php://input'),1);
        $members_id = $request['members_id'];
        $content = $request['content'];
        $contact = $request['contact'];

        // $members_id = 1;
        // $content = '反馈内容';
        // $contact = '365897@qq.com/13111111111';

        if (!$members_id) {
           echo encode(['code' => '1','msg' => '缺少必要参数members_id']); return;
        }
        if (!$content) {
           echo encode(['code' => '1','msg' => '缺少必要参数content']); return;
        }
        if (!$contact) {
           echo encode(['code' => '1','msg' => '缺少必要参数contact']); return;
        }
        $members = M('members')->field('headimgurl, nickname, username')->where(['id' => $members_id])->find();
        $data = array(
          'members_id'  => $members_id,
          'headimgurl'  => $members['headimgurl'],
          'nickname'    => $members['nickname'],
          'username'    => $members['username'],
          'content'     => $content,
          'contact'     => $contact,
          'ip'          => get_client_ip(),
          'create_time' => time(),
        );
        $rs = M('messages')->data($data)->add();
        if ($rs){
            echo encode(['code' => '1','msg' => "提交成功"]);
        }else{
            echo encode(['code' => '0','msg' => '提交失败']);
        }
    }








}