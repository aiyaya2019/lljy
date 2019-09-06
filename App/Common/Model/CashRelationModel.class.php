<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class CashRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'cash';
	//定义关联关系
	protected $_link = array(
		'members'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'members_id',
			'as_fields'=>'nickname,headimgurl,userphone,username',             //name表示要用的字段，cate表示要映射到谁上面
		),
		'bank'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'bank_id',
			'as_fields'=>'bank_number,bank_username,bank_cate_id',             //name表示要用的字段，cate表示要映射到谁上面
		)
	);
}