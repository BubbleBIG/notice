<?php
header("Content-type: text/html; charset=utf-8");
$host="localhost";
$db_user="root";
$db_pass="";
$db_name="notice";

$link=mysqli_connect($host, $db_user, $db_pass);
mysqli_select_db($link, $db_name);
mysqli_query($link," SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('PRC'); //北京时间
?>