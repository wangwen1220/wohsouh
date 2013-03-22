<?php
header("Content-type:text/html;charset=utf-8");
//$str = "四川省成都市文家巷12号";
$str = "广东省深圳市文家巷12号";

preg_match("/省(.+)市/",$str,$matches);
print_r($matches[1]);

echo "<br>====================================<br>";

if (preg_match ("/省/", $str)) {
   print "找到！";
} else {
   print "没有找到！";
}

echo "<br>====================================<br>";

$str1="Microsoft Office Word 2003";
//$str1 = 'user@example.com';
if (ereg("[.]*soft[.]*Word[.]*",$str1))
{
	echo '1:'.$str1;
}
else
{
    echo '2:'.$str1;
}

echo "<br>====================================<br>";


$str1="Microsoft Office Word 2003";

if(false!==strpos($str1,'soft') && false!==strpos($str1,'Word') ){
	echo '1:'.$str1;
}else{
	echo '2:'.$str1;
}

echo "<br>====================================<br>";


?>