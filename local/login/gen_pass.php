    <?php 
	include'config/connect.pis.php';
	$pass = md5('123');
	$pass1=md5($pass);
	$sql="insert into user(id,password,password1) values(0,'$pass','$pass1')";
	mysql_query("SET NAMES UTF8");
	$query = mysql_query($sql);
	mysql_close();

	?>