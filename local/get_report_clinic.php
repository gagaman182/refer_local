<?php	
	session_start();
	include("../config/conn_refer.php");

	
	mysql_close($conn);

	function chk_app_status($hn,$placecode,$date_app){	
		include("../config/conn.php");
		$hn=explode("/",$hn);
		$run_hn=$hn[0];
		$year_hn=$hn[1];
		$sql="select count(DISTINCT concat(concat(PAT_RUN_HN,'/'),pat_year_hn)) from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' AND PLA_PLACECODE='".$placecode."' AND to_char(APP_DATE,'yyyy-mm-dd')='".$date_app."' AND DEL_FLAG is NULL";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_refer_status($referno){	
		include("../config/conn.php");
		
		$sql="select count(*) from PATIENTS_REFER_HX WHERE IMPORTANT_NO='".$referno."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_appoint_status($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND OPD_VISIT_TYPE='D' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND PLA_PLACECODE='".$placecode."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

?>