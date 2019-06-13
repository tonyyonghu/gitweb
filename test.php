<?php
	$a = 'c' ;

$b = & $a ; //表示$b 和 $a 引用了同一个变量

$a = 'abc' ; //这里重置了$a

echo $b ; //将输出abc

unset( $a ); //取消引用

echo $b ; //这里仍输出 abc

$a = 'abcd' ;

echo $b ; //因为已经取消引用 这里仍输出abc
?>