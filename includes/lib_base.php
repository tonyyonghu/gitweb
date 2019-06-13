<?php
defined('ACC')||exit('Access Denied');

function addslashes_real(&$str) {
    $str = addslashes($str);
}


function insert_user() {
    if(empty($_SESSION['user'])) {
        return '<a href="user_login.html">
                        会员登录
                    </a>
                    |
                    <a href="user_login.html">
                        免费注册
                    </a>';
    } else {
        return $_SESSION['user']['username'] .' 欢迎你!
                        <a href="logout.php">退出</a>';
    }
}
