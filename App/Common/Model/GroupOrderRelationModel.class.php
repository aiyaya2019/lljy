<?php
namespace Common\Model;
use Think\Model\RelationModel;
Class GroupOrderRelationModel extends RelationModel{
	//定义主表名称
	protected $tableName = 'group_order';
	//定义关联关系
	protected $_link = array(
		'members'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'members_id',
			'as_fields'=>'nickname,headimgurl,openid,userphone,username',             //name表示要用的字段，cate表示要映射到谁上面
		),
		'group_goods'=>array(
			'mapping_type'=>self::BELONGS_TO,     //多对多关系
			'foreign_key'=>'group_goods_id',
			'as_fields'=>'name:group_goods_name,pic:group_goods_pic,group_price:group_goods_price,group_num:group_goods_num,title:group_goods_title,save_num:group_goods_saveNum,price:group_goods_money',        
		),
	);
}