<?php
   // 数组转JSON函数
    function encode($arr){
        $result = json_encode($arr,JSON_UNESCAPED_UNICODE);
		return $result;
    }
?>