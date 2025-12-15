<?php
header('Content-Type: application/json');
	include '../config/conn.php';

	if($_POST['lookup']=='blood'){
		$sql="select BLOOD_GR_ID,'('||BLOOD_GR_ID||') '||NAME from BLOOD_GROUPS ORDER BY BLOOD_GR_ID";		
	}elseif($_POST['lookup']=='eth'){
		$sql="select ETHNIC_ID,'('||ETHNIC_ID||') '||NAME from ETHNICS WHERE DEL_FLAG IS NULL ORDER BY ETHNIC_ID";		
	}elseif($_POST['lookup']=='native'){
		$sql="select NATIVE_ID,'('||NATIVE_ID||') '||NAME from NATIVE_CODE WHERE DEL_FLAG IS NULL ORDER BY NATIVE_ID";
	}elseif($_POST['lookup']=='rel'){
		$sql="select RELIGION_ID,'('||RELIGION_ID||') '||NAME from RELIGIONS WHERE DEL_FLAG IS NULL ORDER BY RELIGION_ID";
	}elseif($_POST['lookup']=='mstatus'){
		$sql="select MARYSTATUS_ID,'('||MARYSTATUS_ID||') '||NAME from MARYSTATUSES WHERE DEL_FLAG IS NULL ORDER BY MARYSTATUS_ID";
	}elseif($_POST['lookup']=='edu'){
		$sql="select EDUCATION_CODE,'('||EDUCATION_CODE||') '||NAME from EDUCATION WHERE DEL_FLAG IS NULL ORDER BY EDUCATION_CODE";
	}elseif($_POST['lookup']=='prof'){
		$sql="select PROFF_ID,'('||PROFF_ID||') '||NAME from PROFFS WHERE DEL_FLAG IS NULL ORDER BY PROFF_ID";
	}elseif($_POST['lookup']=='prov'){
		$sql="select PROV_CODE,'('||PROV_CODE||') '||PROV_NAME from PROVINCES ORDER BY PROV_CODE";
	}elseif($_POST['lookup']=='amp'){
		$sql="SELECT dist_code,'('||dist_code||') '||dist_name FROM DISULTS WHERE DISULTS.PRO1_PROV_CODE='".$_POST['prov_code']."' ORDER BY DIST_CODE";
	}elseif($_POST['lookup']=='tambon'){
		$sql="select code,'('||code||') '||name from ADDRESS WHERE TYPE='3' AND CODE LIKE '".$_POST['amp_code']."%' ORDER BY CODE";
	}elseif($_POST['lookup']=='places'){
		$sql="select PLACECODE,FULLPLACE FROM PLACES WHERE DEL_FLAG is NULL AND PT_PLACE_TYPE_CODE='1' AND PLACECODE NOT LIKE 'PCU%' AND PLACECODE NOT LIKE 'RP%' AND PLACECODE NOT LIKE 'CM%' AND FULLPLACE NOT LIKE 'PT%' AND FULLPLACE NOT LIKE 'ประวัติ%'";
	}
	
	$data=array();
	set_time_limit(0);		
	$st = oci_parse($con,$sql);
	oci_execute($st,OCI_DEFAULT);
	while($rs = oci_fetch_array($st,OCI_BOTH)) {
		$a['id']=$rs[0];
		$a['text']=$rs[1];
		array_push($data,$a);
	}

	echo json_encode($data);
	oci_close($con);
?>