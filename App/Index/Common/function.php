<?php
  // 截取函数
    function bankStr($str){
    	$newstr = '';
    	$arr = str_split($str);
        foreach ($arr as $k => $v) {
        	if (($k+1)%4==0) {
        		$newstr.=$v."&nbsp;";
        	}else{
        		$newstr.=$v;
        	}
        }
        return $newstr;
    }
?>