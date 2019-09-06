<?php
Class Category{
	Static public function unlimitedForLevel($cate, $html = "--", $pid= 0, $level = 0){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid']==$pid) {
				$v['level']=$level+1;
				$v['html']=str_repeat($html,$level);
				$arr[]=$v;
				$arr = array_merge($arr,self::unlimitedForLevel($cate,$html,$v['id'],$level+1)); 
			}
		}
		return $arr;
	}
	Static public function unlimitedForLayer($cate, $name='child', $pid= 0){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid']==$pid) {
				$v[$name]=self::unlimitedForLayer($cate,$name,$v['id']);
				$arr[]=$v;
			}
		}
		return $arr;
	}
	Static public function getChildsId($cate, $pid){
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid']==$pid) {
				$arr[]=$v['id']; 
				$arr=array_merge($arr,self::getChildsId($cate,$v['id']));
			}
		}
		return $arr;
	}
}
?>