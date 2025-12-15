<?php
	include("../config/conn_refer.php");
	$data=array();
	$sql="select bid,date_format(datestart,'%d-%m-%Y') as datestart_th,date_format(dateend,'%d-%m-%Y') as dateend_th,datestart,dateend 
	from holiday_doctor 
	where placecode='".$_REQUEST['pla']."' 
	order by bid desc";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$a['bid']=$rs['bid'];
		$a['datestart_th']=$rs['datestart_th'];
		$a['dateend_th']=$rs['dateend_th'];
		$a['datestart']=$rs['datestart'];
		$a['dateend']=$rs['dateend'];
		$a['del']='<i class="fas fa-trash-alt text-danger"></i>';
		array_push($data,$a);
	}
	echo json_encode($data);
	mysql_close($conn);

?>