<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'     => 'Index',             //默认模块
    'TOKEN_ON'           => true,                 // 是否开启令牌验证
    'TOKEN_NAME'         => '__hash__',           // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE'         => 'md5',                // 令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'        => true,                 // 令牌验证出错后是否重置令牌 默认为true
	// 数据库配置
	'DB_TYPE'            => 'MySQL',             // 数据库类型
    'DB_HOST'            => '127.0.0.1',         // 服务器地址
    'DB_NAME'            => 'lljy',  // 数据库名
    'DB_USER'            => 'root',              // 用户名
    'DB_PWD'             => 'root',              // 密码
    'DB_PORT'            => 3306,                // 端口
    'DB_PREFIX'          => 'tbkl_',             // 数据库表前缀 
    'DB_CHARSET'         => 'utf8',              // 字符集
    'DB_DEBUG'           =>  TRUE,               // 数据库调试模式 
    'RBAC_SUPERADMIN'    => 'kaili',              // 超级管理员名称
    'ADMIN_AUTH_KEY'     => 'kaili',
    'NOT_AUTH_MODULE'    => 'Login,Index,Ajax,Common',    //无需验证的控制器
    'NOT_AUTH_ACTION'    => 'agent_editHandle,configHandle,bannerArr,baseHandle,helpHandel,logistics_editHandle,goods_editHandle,goods_cate_editHandle,goods_label_editHandle,nav_editHandle,index_nav_editHandle,index_adv_editHandle,index_product_editHandle,order_editHandle,addAttrCate,attrHandel,getoptionid,getAttrOptionList,address_editHandle,barcodeHandle,bank_cate_editHandle,editHandle,share_editHandle,email_editHandle',               //无需验证的动作方法
    'URL_MODEL'          => 2,
    'USER_AUTH_ON'       => '1',
    'USER_AUTH_TYPE'     => '1',                     //2为即时验证模式，别的数字为登陆验证
    'RBAC_ROLE_TABLE'    => 'tbkl_role',
    'RBAC_USER_TABLE'    => 'tbkl_role_user',
    'RBAC_ACCESS_TABLE'  => 'tbkl_access',
    'RBAC_NODE_TABLE'    => 'tbkl_node',
    'company_name'       => '龙领教育',
    'SEND_MSG_URL'      =>  $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].'/Api/WxSend/apisendMsg',
    "submit"            =>  array(
                                array(
                                    "name"=>"收货地址",
                                    "is_need"=>true
                                ),
                                array(
                                    "name"=>"姓名",
                                    "is_need"=>false
                                ),
                                array(
                                    "name"=>"电话",
                                    "is_need"=>true
                                ),
                            )
);