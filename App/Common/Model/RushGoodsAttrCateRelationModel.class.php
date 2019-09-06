<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class RushGoodsAttrCateRelationModel extends RelationModel{
//定义主表名称
	Protected $tableName = 'rush_attr_cate';
	//定义关联关系
	Protected $_link = array(
		'rush_attr_option'=>array(
			'mapping_type'=>self::HAS_MANY, //多对多关系
			'foreign_key'=>'attr_cate_id' 
		)
	);
}
?>