<?php
namespace Api\Controller;
use Think\Controller;

class ApplyController extends CommonController {

	/**
	 * 学员申请
	 * $members_id 会员id
	 * $name       学员姓名
	 * $idcard     身份证
	 * $height     身高
	 * $weight     体重
	 * $sex        性别：0未知；1男；2女
	 * $age        年龄
	 * $health     身体状况
	 * $father     学员父亲
	 * $pidcard    父亲身份证
	 * $pphone     父亲联系电话
	 * $mother     学员母亲
	 * $midcard    母亲身份证
	 * $mphone     母亲联系电话
	 * $address    家庭住址
	 * $info       学员资料
	 * $remarks    备注
	 * $is_sign    是否签名：0不签名；1签名
	 */
	public function apply(){
		$request = json_decode(file_get_contents("php://input"), 1);

		// $request['members_id'] = 1;
		// $request['name']       = '学员姓名';
		// $request['idcard']     = 'idcard';
		// $request['height']     = '170';
		// $request['weight']     = '50';
		// $request['sex']        = 1;
		// $request['age']        = '20';
		// $request['health']     = '良好';
		// $request['father']     = 'father';
		// $request['pidcard']    = 'pidcard';
		// $request['pphone']     = '13111111111';
		// $request['mother']     = 'mother';
		// $request['midcard']    = 'midcard';
		// $request['mphone']     = '13111111111';
		// $request['address']    = 'address';
		// $request['info']       = 'info';
		// $request['remarks']    = 'remarks';
		// $request['is_sign']    = 1;

		$members_id = $request['members_id'];
		$name       = $request['name'];
		$idcard     = $request['idcard'];
		$height     = $request['height'];
		$weight     = $request['weight'];
		$sex        = $request['sex'];
		$age        = $request['age'];
		$health     = $request['health'];
		$father     = $request['father'];
		$pidcard    = $request['pidcard'];
		$pphone     = $request['pphone'];
		$mother     = $request['mother'];
		$midcard    = $request['midcard'];
		$mphone     = $request['mphone'];
		$address    = $request['address'];
		$info       = $request['info'];
		$remarks    = $request['remarks'];
		$is_sign    = $request['is_sign'];

		if (!$members_id) {
			echo json_encode(['status' => '0', 'msg' => '缺少必需参数members_id']);return;
		}
		if (!$name) {
			echo json_encode(['status' => '0', 'msg' => '请输入学员姓名']);return;
		}
		if (!$idcard) {
			echo json_encode(['status' => '0', 'msg' => '请输入身份证']);return;
		}
		if (!$height) {
			echo json_encode(['status' => '0', 'msg' => '请输入身高']);return;
		}
		if (!$weight) {
			echo json_encode(['status' => '0', 'msg' => '请输入体重']);return;
		}
		if ($sex == '') {
			echo json_encode(['status' => '0', 'msg' => '请选择性别']);return;
		}
		if (!$age) {
			echo json_encode(['status' => '0', 'msg' => '请输入年龄']);return;
		}
		if (!$health) {
			echo json_encode(['status' => '0', 'msg' => '请输入身体状况']);return;
		}
		if (!$father) {
			echo json_encode(['status' => '0', 'msg' => '请输入学员父亲']);return;
		}
		if (!$pidcard) {
			echo json_encode(['status' => '0', 'msg' => '请输入父亲身份证']);return;
		}
		if (!$pphone) {
			echo json_encode(['status' => '0', 'msg' => '请输入父亲联系电话']);return;
		}
		if (!$mother) {
			echo json_encode(['status' => '0', 'msg' => '请输入学员母亲']);return;
		}

		if (!$midcard) {
			echo json_encode(['status' => '0', 'msg' => '请输入母亲身份证']);return;
		}
		if (!$mphone) {
			echo json_encode(['status' => '0', 'msg' => '请输入母亲联系电话']);return;
		}
		if (!$address) {
			echo json_encode(['status' => '0', 'msg' => '请输入家庭住址']);return;
		}
		if (!$info) {
			echo json_encode(['status' => '0', 'msg' => '请输入学员资料']);return;
		}
		// if (!$remarks) {
		// 	echo json_encode(['status' => '0', 'msg' => '请输入备注']);return;
		// }
		// if ($is_sign === null) {
		// 	echo json_encode(['status' => '0', 'msg' => '签名']);return;
		// }
		$request['create_time'] = time();
		$res = M('apply')->add($request);
		if ($res) {
			echo json_encode(['status' => '1', 'msg' => '提交成功']);
		}else{
			echo json_encode(['status' => '0', 'msg' => '提交失败，请联系管理员']);
		}
	}











}