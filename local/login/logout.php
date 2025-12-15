<?php
session_start();
session_destroy();
header("Location: index.php");
//$r=mysql_fetch_array($sth);
?>
