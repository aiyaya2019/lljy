<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class OrderListRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'mall_order_list';
	//定义关联关系
	protected $_link = array(
		'goods'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'goods_id'
		)
	);
}