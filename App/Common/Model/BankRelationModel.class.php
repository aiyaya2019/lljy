<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class BankRelationModel extends RelationModel{
//定义主表名称
	Protected $tableName = 'bank';
	//定义关联关系
	Protected $_link = array(
		'bank_cate'=>array(
			'mapping_type'=>self::BELONGS_TO, //多对多关系
			'foreign_key'=>'bank_cate_id',
			'as_fields'=>'name:bank_name', 
		)
	);
}
?>