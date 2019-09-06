<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class EvaluateRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'order_evaluate';
	//定义关联关系
	protected $_link = array(
		'goods'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'goods_id',
			'as_fields'=>'name,pic',             //name表示要用的字段，cate表示要映射到谁上面
		),
		'members'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'members_id',
			'as_fields'=>'nickname,headimgurl',             //name表示要用的字段，cate表示要映射到谁上面
		),
	);
}