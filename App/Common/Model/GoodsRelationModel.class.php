<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class GoodsRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'goods';
	//定义关联关系
	protected $_link = array(
		'goods_cate'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'goods_cate_id',
			'as_fields'=>'name:goods_cate',             //name表示要用的字段，cate表示要映射到谁上面
		),
		'label'=>array(
			'mapping_type'=>self::MANY_TO_MANY,   //多对多关系
			'foreign_key'=>'goods_id',
			'relation_foreign_key'=>'label_id',
			'relation_table'=>'tbkl_goods_label'
		)
	);
}