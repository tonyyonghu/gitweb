<?php
defined('ACC')||exit('Access Denied');

// 分页类
class page {
    public $total;  // 全部条目
    public $perpage = 10;  //每页条目

    protected $curr = 1; //当前页码

    public function __construct($total,$perpage='') {
        $this->total = $total;  // 把总条目信息放在total属性
        if($perpage > 0) {
            $this->perpage = $perpage;  // 把每页数量放在perpage属性
        }

        // 计算当前页码
        if(isset($_GET['page']) && ($_GET['page'] + 0) > 0) {
            $this->curr = $_GET['page'] + 0;
        }
    }

    // 返回当前页码
    public function curr() {
        return $this->curr;
    }

    // 主体函数,
    public function show() {
        if($this->total <=0 ) { // 不是检验合法,检验因为疏忽带来的可能错误.
            return '';   // 如果总条目<=0, 直接返回空字符串
        }

        $cnt = ceil($this->total / $this->perpage); // 算总页数,进一取整

        // 分析url, 有哪几种情况?
        /*
        xx.php
        xx.php?id=5        
        xx.php?page=3
        xx.php?id=5&page=3
        */

        // 最终生成的url里必然有page=N
        $url = $_SERVER['REQUEST_URI'];
        $parse = parse_url($url); // 把uri的分析结果放数组里
        
        // 保证参数里有page=N
        if(!isset($parse['query'])) {
            $parse['query'] = 'page=' . $this->curr;
        }

        // 把query字符串分析成数组,再次确保数组里有page选项

        parse_str($parse['query'],$parms);

        if(!array_key_exists('page',$parms)) {
            $parms['page'] = $this->curr;
        }

        // 把上面的4种url情况都测试一遍,page参数都能合理生成
        // print_r($parms);
        //$parse['path']='/list_';
        // 判断除了page之外,还有没有其他参数
        if(count($parms) == 1) {
            $url = $parse['path'] . '?';
        } else {
            unset($parms['page']);
            $url = $parse['path'] . '?' . http_build_query($parms) . '&';
        }
        
       $url="/list_";
        $prev = $this->curr - 1;
        $next = $this->curr + 1;

        if($prev < 1) {
            $prevLink = '';
        } else {
            //$prevLink = '<li><a href="' . $url . 'page=' . $prev . '">上一页</a></li>';
            $prevLink = '<li><a href="' . $url . $prev . '.html">上一页</a></li>';
        }

        if($next > $cnt) {
            $nextLink = '';
        } else {
            //$nextLink = '<li><a href="' . $url . 'page=' . $next . '">下一页</a></li>';
            $nextLink = '<li><a href="' . $url .  $next . '.html">下一页</a></li>';
        }

        // echo $prevLink,'&nbsp;',$nextLink;
        
        
        // 首页 上一页 -1 0 1 2 3 4 5 下一页 尾页
        
         
        /* */
        // by ChenLiWen

        $start = $this->curr - (5-1)/2; // 计算左侧开始的页码
        $end = $this->curr + (5-1)/2;   // 计算右侧开始的页码
        
        $start = $start < 1 ? 1: $start;
        $end = ($start + 5 - 1) > $cnt ? $cnt : ($start + 5 - 1);

        // 把右侧超出的部分,补到左边去
        
        $end = $end > $cnt ? $cnt :  $end;
        $start = ($end - 5 + 1) < 1 ? 1 : $end - 5 + 1;
        
        
        /*
            // by WangYunJie
        

        if($cnt <= 5) {
            $start = 1;
            $end = $cnt;
        } else {     
            $start = $this->curr - (5-1)/2; // 计算左侧开始的页码
            $end = $this->curr + (5-1)/2;   // 计算右侧开始的页码
            
            if($start < 1) {
                $start = 1;
                $end = 5;
            }

            if($end > $cnt) {
                $end = $cnt;
                $start = $cnt - 5 + 1; // $cnt > 5,因此,$cnt -5 + 1 > 1,不会越界
            }
        }
        */

        //echo $start,$end;
        $pageStr = '';
        
        for($i = $start;$i <= $end;$i++) {
            if($i == $this->curr) {
                $pageStr .= $i;
                continue;
            }
            //$pageStr .= '<li><a href="' . $url . 'page=' . $i . '">' . $i . '</a></li>';
            $pageStr .= '<li><a href="' . $url .  $i . '.html">' . $i . '</a></li>';
        }
		//echo $prevLink;
        return $prevLink . $pageStr . $nextLink;
        
    }

}


/*
// controller, goodslist.php
// $total = select count() from goods;


$page = new page(30,3);
echo $page->show();
*/




/*
1:目前每页页码是 5个, 能否改成参数来指定,比如指定10, (注意取整)
就显示1 2 3 4 5 6 7 8 9 10这种导航效果

2: 加上首页,尾页的效果

3: 能否让url里的分页参数不是page,而是由参数指定, 例如pg,num,等
*/
