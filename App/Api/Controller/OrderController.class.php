<?php
namespace Api\Controller;
use Think\Controller;
class OrderController extends CommonController {

	/**
	 * 生成订单信息  
	 * $type       订单类型：0购买视频；1购买vip
	 * $members_id 会员id
	 * $vip_id     vip id
	 * $video_id   视频id
	 * $pay_money  支付金额
	 */
	public function addOrder(){
		$request = json_decode(file_get_contents("php://input"), 1);
		$request = empty($request)?I('post.'):$request;

		// $request = [
		// 	'type' => '0',
		// 	'members_id' => '3',
		// 	// 'vip_id' => '1',
		// 	'video_id' => '29',
		// 	'pay_money' => '0.01',
		// ];

		if (!$request['members_id']) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数members_id']);return;
		}
		if (!$request['pay_money']) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数pay_money']);return;
		}

		if ($request['type'] === null) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数type']);return;
		}else{

			$request['ordercode']   = randomCode();
			$request['create_time'] = time();

			if ($request['type'] == '0') {//购买视频
				if (!$request['video_id']) {
					echo json_encode(['status' => '0', 'msg' => '缺少必需参数video_id']);return;
				}

				$video = M('video')->where(['id' => $request['video_id']])->find();
				if ($video) {
					//入库订单信息表
					$order_info = [
						'ordercode'   => $request['ordercode'],
						'members_id'  => $request['members_id'],
						'video_id'    => $request['video_id'],
						'cate_id'     => $video['cate_id'],
						'cate_name'   => M('video_cate')->where(['id' => $video['cate_id']])->getField('name'),
						'title'       => $video['title'],
						'pic'         => $video['pic'],
						'video'       => $video['video'],
						'video_price' => $video['price'],
						'show_time'   => $video['show_time'],
						'desp'        => $video['desp'],
						'content'     => $video['content'],
						'is_pay'      => $video['is_pay'],
						'create_time' => time(),
					];
				}

			}else{//购买vip
				if (!$request['vip_id']) {
					echo json_encode(['status' => '0', 'msg' => '缺少必需参数vip_id']);return;
				}
				$vip = M('vip')->where(['id' => $request['vip_id']])->find();
				if ($vip) {
					//入库订单信息表
					$order_info = [
						'ordercode'   => $request['ordercode'],
						'members_id'  => $request['members_id'],
						'vip_id'      => $request['vip_id'],
						'vip_name'    => $vip['name'],
						'vip_price'   => $vip['price'],
						'create_time' => time(),
					];
				}
			}
		}

		M()->startTrans();//启动事务
		$res_order      = M('order')->add($request);
		$res_order_info = M('order_info')->add($order_info);
		if ($res_order && $res_order_info) {
			M()->commit();//提交事务
			$openid = M('members')->where(['id' => $request['members_id']])->getField('openid');
			$params = $this->wxpay('微信支付', $order_info['ordercode'], $request['pay_money'], $openid);
			$params['ordercode'] = $order_info['ordercode'];
			echo json_encode(['status' => '1', 'msg' => '下单成功','data' => $params]);
			
		}else{
			M()->rollback();//事务回滚
			echo json_encode(['status' => '0', 'msg' => '下单失败']);return;
		}

	}






}