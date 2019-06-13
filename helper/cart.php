<?php
defined('ACC')||exit('Access Denied');


// 购物车的类

// 保证购物车同时只有一个: 单例+session
/* 
分析购物车所有的功能:

添加商品
修改商品数量
删除一个商品
查看某一个商品的数量
查看商品的种类
查看商品的总数量
计算购物车里总价格
返回购物车商品列表
清空购物车
*/




class cart {
    static protected $ins = false;
    protected $item = array();

    final protected function __construct() {
    }

    final protected function __clone() {
    }

    // 获得单例
    static protected function getIns() {
        if(self::$ins === false) {
            self::$ins = new self();
        }

        return self::$ins;
    }


    // 如何把对象放到session里去,并保证session里也只有这一个对象
    static public function getCart() {
        if(!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof self)) {
            $_SESSION['cart'] = self::getIns();
        }
        
        return $_SESSION['cart'];
    }

    // 添加商品, goods_id,goods_name,shop_price,num
    public function addItem($id,$name,$price,$num=1) {
        if($this->getItem($id)) {
            $this->increItem($id,$num);
            return;
        }

        $this->item[$id] = array();
        $this->item[$id]['name'] = $name;
        $this->item[$id]['price'] = $price;
        $this->item[$id]['num'] = $num;
    }

    // 修改商品的数量
    public function modItem($id,$num) {
        /*
        如果 有这个商品,则修改,
        否则,则为添加操作
        */
        if($num == 0) {
            $this->delItem($id);
            return;
        }

        if($this->getItem($id)) {
            $this->item[$id]['num'] = $num;
            return $num;
        } else {
            return false;
        }
    }

    // 商品数量加1,减1的效果
    public function increItem($id,$num=1) {
        if($this->getItem($id)) {
            $this->item[$id]['num'] += $num;
            return $this->item[$id]['num'];
        } else {
            return false;
        }
    }

    // 商品数量减1的效果
    public function decreItem($id) {
        if($this->getItem($id)) {
            $this->item[$id]['num'] -= 1;
            if($this->item[$id]['num'] == 0) {
                $this->delItem($id);
                return 0;
            }

            return $this->item[$id]['num'];
        } else {
            return false;
        }
        
    }


    // 读取购物车中某个商品的数量
    public function getItem($id) {
        if(!array_key_exists($id,$this->item)) {
            return false;
        } else {
            return $this->item[$id]['num'];
        }
    }

    // 删除某一个商品
    public function delItem($id) {
        if($this->getItem($id) !== false) {
            unset($this->item[$id]);
        }

        return true;
    }

    // 查看商品的种类
    public function getCount() {
        return count($this->item);
    }

    // 查看商品的数量
    public function getSum() {
        if($this->getCount() == 0) {
            return 0;
        }
        
        $sum = 0;
        foreach($this->item as $v) {
            $sum += $v['num'];
        }

        return $sum;
    }

    // 计算购物的商品的总价格
    public function getMoney() {
        if($this->getCount() == 0) {
            return 0;
        }

        $money = 0;
        foreach($this->item as $v) {
            $money += $v['num'] * $v['price'];
        }

        return $money;
    }

    // 返回购物车的商品列表
    public function listItem() {
        return $this->item;
    }

    // 清空购物车
    public function clearItem() {
        $this->item = array();
    }

}


/*
session_start();


$cart = cart::getCart();

$act = $_GET['act'];



// 添加商品
if($act == 'add') {
    $cart->addItem(34,'天宇',218.67,1);
    echo '添加到购物车';
}

if($act == 'add2') {
    $cart->addItem(35,'金立',345.67,2);
    echo '添加金立成功';
}

// 修改商品数量
if($act == 'mod') {
    $cart->modItem(34,10);
    echo '修改成功';
}

// 商品加1

// 商品-1

// 计算价格,种类,数量

// 删除商品


// 打印购物车的商品信息
if($act == 'show') {
    echo '共', $cart->getCount(),'种商品,共', $cart->getSum(),'件,',$cart->getMoney(),'<br />';
    print_r($cart->listItem());
}


// 清空购物车

if($act == 'clear') {
    $cart->clearItem();
    echo '清空';
    exit;
}

*/