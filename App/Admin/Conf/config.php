<?php
return array(
	'TMPL_CACHE_ON' => false,
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'=>array(
	  '__PUBLIC__'=>__ROOT__.'/App/'. MODULE_NAME . '/View/Public',
	  '__JS__'=>__ROOT__.'/App/'. MODULE_NAME . '/View/Public/js',
	  '__CSS__'=>__ROOT__.'/App/'. MODULE_NAME . '/View/Public/css',
	  '__IMG__'=>__ROOT__.'/App/'. MODULE_NAME . '/View/Public/images',
	  '__PLUG__'=>__ROOT__.'/App/'. MODULE_NAME . '/View/Public/plug',
	),
	'page'=>10
);
?>