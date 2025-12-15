<?php 
session_start();
include'../../config/conn_refer.php';
//include '../function/conv_date.php';

$sql="SELECT hospcode,hospname FROM utables where hospcode='".$_POST['username']."' and password='".md5($_POST['password'])."'";

mysql_query("SET NAMES UTF8") or die(mysql_error());
$query = mysql_query($sql);
$numrow=mysql_num_rows($query);
$rs=mysql_fetch_array($query);

if($numrow==1){
	echo $numrow;
	$_SESSION['hospcode'] = $rs[0];	
	$_SESSION['hospname'] = $rs[1];
}

mysql_close();
?>