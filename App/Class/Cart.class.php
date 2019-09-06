<?php
class Cart{

    public function __cunstruct() {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
    }
 
    /*
    添加商品
    param int $id 商品主键
          string $name 商品名称
          float $price 商品价格
          int $num 购物数量
    */
    public  function addItem($id,$name,$price,$num,$img,$goods_attr) {
        if ($goods_attr) {
            $attr_str = "";
            foreach ($goods_attr as $k => $v){
                if ($k) {
                    $attr_str .= ",".$v['id'];
                }else{
                   $attr_str .= $v['id'];
                }
            }
        }
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($id ==$v['id'] && $v['attr_str']==$attr_str){
                 //如果该商品已存在则直接加其数量
                $this->incNum($id,$num,$attr_str);
                return;
            }
        }
        $item = array();
        $item['id'] = $id;
        $item['name'] = $name;
        $item['price'] = $price;
        $item['num'] = $num;
        $item['pic'] = $img;
        $item['attr'] = $goods_attr;
        $item['attr_str'] = $attr_str;
        $_SESSION['cart'][] = $item;
    }
 
    /*
    修改购物车中的商品数量
    int $id 商品主键
    int $num 某商品修改后的数量，即直接把某商品
    的数量改为$num
    */
    public function modNum($id,$num=1) {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $_SESSION['cart'][$id]['num'] = $num;
    }
 
    /*
    商品数量+1
    */
    public function incNum($id,$num=1,$attr_str) {
        // dump($_SESSION['cart']);
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($id == $v['id'] && $v['attr_str'] ==$attr_str) {
                $_SESSION['cart'][$k]['num'] += $num;
            }
        }
    }
    /*
    商品数量-1
    */
    public function decNum($id,$num=1,$attr_str) {
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($id == $v['id'] && $v['attr_str'] ==$attr_str) {
                $_SESSION['cart'][$k]['num'] -= $num;
            }
            //如果减少后，数量为0，则把这个商品删掉
            if ($_SESSION['cart'][$k]['num'] <1) {
                $this->delItem($id,$attr_str);
            }
        }
    }
 
    /*
    删除商品
    */
    public function delItem($id,$attr_str) {
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($id == $v['id'] && $v['attr_str'] == $attr_str) {
                unset($_SESSION['cart'][$k]);
            }
        }
    }
     
    /*
    获取单个商品
    */
    public function getItem($id,$attr_str) {
        $arr = array();
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($id == $v['id'] && $v['attr_str'] == $attr_str) {
               $arr = $_SESSION['cart'][$k];
            }
        }
        return $arr;
    }
 
    /*
    查询购物车中商品的种类
    */
    public function getCnt() {
        return count($_SESSION['cart']);
    }
     
    /*
    查询购物车中商品的个数
    */
    public function getNum(){
        if ($this->getCnt() == 0) {
            //种数为0，个数也为0
            return 0;
        }
 
        $sum = 0;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $sum += $item['num'];
        }
        return $sum;
    }
 
    /*
    购物车中商品的总金额
    */
    public function getAllPrice() {
        //数量为0，价钱为0
        if ($this->getCnt() == 0) {
            return 0;
        }
        $price = 0.00;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $price += $item['num'] * $item['price'];
        }
        return sprintf("%01.2f", $price);
    }
    public function getPrice($data){
        //数量为0，价钱为0
        if ($this->getCnt() == 0) {
            return 0;
        }
        $price = 0.00;
        foreach ($data as $k => $v) {
            $arr = $this->getItem($v['goods_id'],$v['attr_str']);
            $price += $arr['num'] * $arr['price'];
        }
        return sprintf("%01.2f", $price);
    }
    /*
    查询购物车所有商品
    */
    public function getShopCart() {
        return $_SESSION['cart'];
    }
    /*
    清空购物车
    */
    public function clear() {
        $_SESSION['cart'] = array();
    }
    /* 获取选中的购物车 */
    public function getCartItem($data){
        $newdata = array();
        foreach ($data as $k => $v) {
            foreach ($_SESSION['cart'] as $key => $val) {
                if ($v['goods_id'] ==  $val['id'] && $v['attr_str'] == $val['attr_str']) {
                     $newdata[$key] = $this->getItem($v['goods_id'],$v['attr_str']);
                }
            }
        }
        return $newdata;
    }
    public function getItemPrice($goods){
        //数量为0，价钱为0
        // if ($this->getCnt() == 0) {
        //     return 0;
        // }
        $price = 0.00;
        $num = 0;
        foreach ($goods as $k => $v) {
            $price += $v['num'] * $v['price'];
            $num+=$v['num'];
        }
        return array('price'=>sprintf("%01.2f", $price),'num'=>$num);
    }
}