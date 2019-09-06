<?php
namespace Api\Controller;
use Think\Controller;

/**
 * 视频控制器--小程序
 */
class VideoController extends CommonController {

	/**
	 * 视频分类
	 */
	public function video_cate(){
		$video_cate = M('video_cate')->field('id, name, pic')->where(['status' => '1'])->order('id desc')->select();
		if ($video_cate) {
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $video_cate]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '获取失败']);
		}
	}

	/**
	 * 视频列表
	 * $page      页码
	 * $cate_id    视频分类id
	 * $members_id 会员id
	 */
	public function video_lst(){
		// echo '<pre>';
		$request    = json_decode(file_get_contents("php://input"),1);
		$page       = $request['page'] ? $request['page'] : '1';
		$cate_id    = $request['cate_id'];
		$members_id = $request['members_id'];
		// $members_id = '1';
		// $cate_id = 8;
		if ($cate_id) {
			$where['cate_id'] = ['eq', $cate_id];
		}
		$where['status'] = ['eq', '1'];
		$field = ('id, cate_id, title, pic, video, is_pay, price, show_time, look, collect, buy_num');
		$video = M('video')->field($field)->where($where)->order('sort asc')->page($page, '10')->select();
		if ($video) {
			$collect_video = $this->collect_video(['members_id' => $members_id]);//收藏的视频
			if ($collect_video) {
				$collect_video = array_column($collect_video, 'video_id', 'video_id');
				foreach ($video as $key => &$value) {
					$video[$key]['show_time'] = date('Y-m-d', $value['show_time']);
					if (!$value['is_pay']) {
						$value['price'] = '免费';
					}
					if (in_array($value['id'], $collect_video)) {
						$video[$key]['is_collect'] = '1';//某用户已收藏该视频
					}else{
						$video[$key]['is_collect'] = '0';//某用户还没收藏该视频
					}
				}
			}else{
				foreach ($video as $key => &$value) {
					$video[$key]['show_time']  = date('Y-m-d', $value['show_time']);
					$video[$key]['is_collect'] = '0';//某用户还没收藏该视频
					if (!$value['is_pay']) {
						$value['price'] = '免费';
					}
				}
			}
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $video]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据']);
		}
	}

	/**
	 * 视频详情
	 * $id         视频id
	 * $members_id 会员id
	 */
	public function video_details(){
		$request    = json_decode(file_get_contents("php://input"),1);
		$request    = empty($request)?I('post.'):$request;
		$id         = $request['id'];
		$members_id = $request['members_id'];

		// $id         = 32;
		// $members_id = 3;
		if (!$id) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数id']);return;
		}
		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数members_id']);return;
		}

		M('video')->where(['id' => $id])->setInc('look');//浏览量+1
		$video_details = M('video')->where(['id' => $id])->find();
		if ($video_details) {
			$is_buy = M('buyinfo')->where(['members_id' => $members_id, 'pro_id' => $id, 'is_pay' => '1'])->find();
			$video_details['is_buy'] = $is_buy ? '1' : '0';
			$is_collect = $this->collect_video(['video_id' => $id, 'members_id' => $members_id]);//判断是否已经收藏该视频
			if ($is_collect) {
				$video_details['is_collect'] = '1';//已收藏该视频
			}else{
				$video_details['is_collect'] = '0';//没收藏该视频
			}
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $video_details]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据']);
		}
	}

	/**
	 * 热门视频
	 */
	public function hot_video(){
		$where['status'] = ['eq', '1'];
		$where['is_red'] = ['eq', '1'];
		$field = ('id, cate_id, title, pic, video, is_pay, price, show_time, look, collect, buy_num');
		$hot_video = M('video')->field($field)->where($where)->order('sort asc')->limit('5')->select();
		if ($hot_video) {
			$num = M('video')->where(['status' => '1'])->count('id');
			$data = ['hot_video' => $hot_video, 'num' => $num];
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $data]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据']);
		}
	}

	/**
	 * 搜索视频
	 * $keywords 视频名称
	 * $limit    当前页面视频数量
	 */
	public function search(){
		$request = json_decode(file_get_contents("php://input"),1);
		$limit   = $request['limit'] ? $request['limit'] + '10' : '10';
		$title   = $request['keywords'];
		// $title   = '视频名称1';
		if (!$title) {
			echo json_encode(['status' => '0', 'msg' => '请输入视频名称']);return;
		}

		// 搜索记录
		$chekc_key = M('keys')->where(['keys' => $title])->find();
		if ($chekc_key) {
			$up_key = [ 'num' => $chekc_key['num']+'1', 'update_time' => time()];
			M('keys')->where(['keys' => $title])->save($up_key);
		}else{
			$add_key = [ 'keys' => $title, 'create_time' => time()];
			M('keys')->add($add_key);
		}

		$where['title']  = ['like', $title];
		$where['status'] = ['eq', '1'];
		$field = ('id, cate_id, title, pic, video, is_pay, price, show_time, look, collect, buy_num');
		$video = M('video')->field($field)->where($where)->order('sort asc')->limit($limit)->select();
		if ($video) {
			$collect_video = $this->collect_video(['members_id' => $members_id]);//收藏的视频
			if ($collect_video) {
				$collect_video = array_column($collect_video, 'video_id', 'video_id');
				foreach ($video as $key => &$value) {
					$video[$key]['show_time'] = date('Y-m-d', $value['show_time']);
					if (!$value['is_pay']) {
						$value['price'] = '免费';
					}
					if (in_array($value['id'], $collect_video)) {
						$video[$key]['is_collect'] = '1';//某用户已收藏该视频
					}else{
						$video[$key]['is_collect'] = '0';//某用户还没收藏该视频
					}
				}
			}else{
				foreach ($video as $key => &$value) {
					$video[$key]['show_time']  = date('Y-m-d', $value['show_time']);
					$video[$key]['is_collect'] = '0';//某用户还没收藏该视频
					if (!$value['is_pay']) {
						$value['price'] = '免费';
					}
				}
			}
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $video]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无数据']);
		}
	}

	/**
	 * 历史搜索词
	 */
	// public function his_keys(){
	// 	$res =  M('keys')->order('id desc')->select();
	// 	if ($res) {
	// 		echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $res]);
	// 	}else{
	// 		echo json_encode(['status' => '0', 'msg' => '暂无历史数据']);
	// 	}
	// }

	/**
	 * 热门搜索词
	 */
	public function hot_keys(){
		$res =  M('keys')->field('id, keys, num')->order('id desc')->select();
		if ($res) {
			echo json_encode(['status' => '1', 'msg' => '获取成功', 'data' => $res]);
		}else{
			echo json_encode(['status' => '0', 'msg' => '暂无热词']);
		}
	}


	/**
	 * 收藏视频/取消收藏视频
	 * $members_id 会员id
	 * $video_id   视频id
	 */
	public function collect_handle(){
		$request = json_decode(file_get_contents("php://input"),1);
		$video_id   = $request['video_id'];
		$members_id = $request['members_id'];
		// $video_id   = 19;
		// $members_id = 1;
		if (!$video_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少video_id']);return;
		}
		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少members_id']);return;
		}
		$where = ['video_id' => $video_id, 'members_id' => $members_id];
		$is_collect = $this->collect_video($where);//判断是否已经收藏该视频
		if ($is_collect) {//已收藏该视频
			$res_collect = M('collect')->where($where)->delete();
			$res_video   = M('video')->where(['id' => $video_id])->setDec('collect');//视频收藏量-1
			if ($res_collect && $res_video) {
				echo json_encode(['status' => '1', 'msg' => '已取消', 'data' => $res_collect]);return;
			}else{
				echo json_encode(['status' => '0', 'msg' => '取消失败']);return;
			}
		}else{//没收藏该视频
			$data = ['video_id' => $video_id, 'members_id' => $members_id, 'create_time' => time()];
			$res_collect = M('collect')->add($data);
			$res_video   = M('video')->where(['id' => $video_id])->setInc('collect');//视频收藏量+1
			if ($res_collect && $res_video) {
				echo json_encode(['status' => '1', 'msg' => '已收藏', 'data' => $res_collect]);return;
			}else{
				echo json_encode(['status' => '0', 'msg' => '收藏失败']);return;
			}
		}
	}


	/**
	 * 视频观看记录
	 * $video_id   视频id
	 * $members_id 会员id
	 */
	public function look_handle(){
		$request    = json_decode(file_get_contents("php://input"),1);

		// $request['video_id']   = 1;
		// $request['members_id'] = 1;

		$video_id   = $request['video_id'];
		$members_id = $request['members_id'];

		if (!$video_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少video_id']);return;
		}
		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少members_id']);return;
		}
		$where = ['video_id' => $video_id, 'members_id' => $members_id];
		$is_look = M('video_look')->where($where)->find();
		if ($is_look) {//已看过该视频
			$arr = [
				'num'       => $is_look['num'] + '1',
				'look_time' => time(),
			];
			$res = M('video_look')->where($where)->save($arr);
		}else{//还没看过该视频
			$request['look_time'] = time();
			$res = M('video_look')->add($request);
		}
		if ($res) {
			echo json_encode(['status' => '1', 'msg' => '操成功']);
		}else{
			echo json_encode(['status' => '0', 'msg' => '操作失败']);
		}

	}

	/**
	 * 判断是否已购买视频/vip及vip是否过期
	 * $pro_id   视频id/vip id
	 * $members_id 会员id
	 * $type       类型：0视频；1vip
	 */
	public function is_buy(){
		$request    = json_decode(file_get_contents("php://input"),1);
		$request    = empty($request)?I('post.'):$request;
		$pro_id     = $request['pro_id'];
		$members_id = $request['members_id'];
		$type       = $request['type'];
		
		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少members_id']);return;
		}
		if ($type == null) {
			echo json_encode(['status' => '0', 'msg' => '缺少type']);return;
		}elseif ($type == '0') {
			if (!$pro_id) {
				echo json_encode(['status' => '0', 'msg' => '缺少pro_id']);return;
			}
		}
		if ($type == '0') {//视频
			$where = ['pro_id' => $pro_id, 'members_id' => $members_id, 'type' => $type, 'is_pay' => '1'];
			$info  = M('buyinfo')->where($where)->find();
			if ($info) {
				echo json_encode(['status' => '1', 'msg' => '已购买该视频']);return;
			}else{
				echo json_encode(['status' => '0', 'msg' => '没有购买该视频']);return;
			}
		}else{//vip
			$where = ['members_id' => $members_id, 'type' => $type, 'is_pay' => '1'];
			$info  = M('buyinfo')->where($where)->find();
			if ($info) {
				if ($info['expire_time'] >= time()) {
					echo json_encode(['status' => '1', 'msg' => '是vip会员']);return;
				}else{
					echo json_encode(['status' => '0', 'msg' => 'vip会员已过期']);return;
				}
			}else{
				echo json_encode(['status' => '0', 'msg' => '不是vip会员']);return;
			}
		}
		
	}











}