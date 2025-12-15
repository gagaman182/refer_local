<?php
	include("../config/conn_refer.php");
	$q=$_POST['q'];
	$q1=$_POST['q1'];
	$data=array();
	if($q=='blood'){
		$sql="select BLOOD_GR_ID,concat(concat(concat('(',BLOOD_GR_ID),') '),NAME) from BLOOD_GROUPS ORDER BY BLOOD_GR_ID";
	}elseif($q=='eth'){
		$sql="select ETHNIC_ID,concat(concat(concat('(',ETHNIC_ID),') '),NAME) from ETHNICS WHERE ETHNIC_ID in('99','98','44','56','57','48','46','44','00') ORDER BY ETHNIC_ID DESC";		
	}elseif($q=='native'){
		$sql="select NATIVE_ID,concat(concat(concat('(',NATIVE_ID),') '),NAME) from NATIVE_CODE WHERE NATIVE_ID in('044','094','095','099','056','057''046','000','044','048','046') ORDER BY NATIVE_ID DESC";
	}elseif($q=='rel'){
		$sql="select RELIGION_ID,concat(concat(concat('(',RELIGION_ID),') '),NAME) from RELIGIONS WHERE DEL_FLAG = '' ORDER BY RELIGION_ID DESC";
	}elseif($q=='mstatus'){
		$sql="select MARYSTATUS_ID,concat(concat(concat('(',MARYSTATUS_ID),') '),NAME) from MARYSTATUSES WHERE DEL_FLAG ='' ORDER BY MARYSTATUS_ID";
	}elseif($q=='edu'){
		$sql="select EDUCATION_CODE,concat(concat(concat('(',EDUCATION_CODE),') '),NAME) from EDUCATION WHERE DEL_FLAG  = '' ORDER BY EDUCATION_CODE";
	}elseif($q=='prof'){
		$sql="select PROFF_ID,concat(concat(concat('(',PROFF_ID),') '),NAME) from PROFFS WHERE DEL_FLAG = '' ORDER BY PROFF_ID";
	}elseif($q=='prov'){
		$sql="select PROV_CODE,concat(concat(concat('(',PROV_CODE),') '),PROV_NAME) from PROVINCES ORDER BY PROV_CODE";
	}elseif($q=='amp'){
		$sql="SELECT dist_code,concat(concat(concat('(',dist_code),') '),dist_name) FROM DISULTS WHERE DISULTS.PRO1_PROV_CODE='".$q1."' ORDER BY DIST_CODE";
	}elseif($q=='tambon'){
		$sql="select code,concat(concat(concat('(',code),') '),name) from ADDRESS WHERE TYPE='3' AND DEL_FLAG= '' AND CODE LIKE '".$q1."%' ORDER BY CODE";
	}
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$a['id']=$rs[0];
		$a['text']=$rs[1];
		array_push($data,$a);
	}
	echo  json_encode($data);
	mysql_close();
?>