<?php
	if(!isset($_REQUEST['hn']) || $_REQUEST['hn']==''){
		die();
	}

	include '../config/conn.php';
	$hn=explode('/',$_REQUEST['hn']);
	$run_hn=$hn[0];
	$year_hn=$hn[1];
	
	$data=array();
	$sql="SELECT PATIENT_PICTURE.PIC_1 FROM PATIENT_PICTURE where PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."'";
	set_time_limit(0);		
	$st = oci_parse($con,$sql);
	oci_execute($st,OCI_DEFAULT);
	while($rs = oci_fetch_array($st,OCI_BOTH)) {
		echo '<img src="data:image/jpeg;base64,' . base64_encode( $rs[0] ) . '" class="img-thumbnail"/>'; 
		//$data=base64_encode($rs[0]);
	}
	echo json_encode($data);
	oci_close($con);
?>