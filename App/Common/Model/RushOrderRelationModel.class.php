<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class RushOrderRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'rush_order';
	//定义关联关系
	protected $_link = array(
		'members'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'members_id',
			'as_fields'=>'nickname,headimgurl',             //name表示要用的字段，cate表示要映射到谁上面
		),
		'rush_goods'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'rush_goods_id',
			'as_fields'=>'name:goods_name,pic:goods_pic,title:goods_title,goods_code'          //name表示要用的字段，cate表示要映射到谁上面
		),
		"logistics"=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'logistics_id',
		)
	);
}