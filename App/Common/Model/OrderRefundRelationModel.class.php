<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class OrderRefundRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'order_refund';

	//定义关联关系
	protected $_link = array(
		'mall_order_list'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'mall_order_list_id',   // 关联的外键名称
			'as_fields'=>'ordercode,buy_num,goods_price,refund_status',             // 需要查询关联表的字段
		),
	);
}