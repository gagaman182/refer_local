<?php
$host_cc="172.16.99.200";
$user_cc="hatyaih";
$password_cc="Com3274*";
$dbname_cc="cc";
$conn_cc=mysql_connect("$host_cc","$user_cc","$password_cc")  or die("ไม่สามารถติดต่อ Host ได้");
mysql_query("SET NAMES UTF8");	
mysql_select_db("$dbname_cc") or die("ไม่สามารถติดต่อ Database ได้");

?>
