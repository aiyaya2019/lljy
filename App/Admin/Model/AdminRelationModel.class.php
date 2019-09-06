<?php
namespace Admin\Model;
use Think\Model\RelationModel;
Class AdminRelationModel extends RelationModel{
//定义主表名称
	Protected $tableName = 'admin';
	//定义关联关系
	Protected $_link = array(
		'role'=>array(
			'mapping_type'=>self::MANY_TO_MANY, //多对多关系
			'foreign_key'=>'user_id',
			'relation_key'=>'role_id',
			'relation_table'=>'tbkl_role_user',
			'mapping_fields'=>'id,name,remark'
			)
		);
}
?>