<?php
	include("../config/conn_refer.php");
		$sql_hn="SELECT DISTINCT cid,referout_no FROM appoint WHERE hn=''";
		$query_hn=mysql_query($sql_hn) or die(mysql_error());
		while($rs_hn=mysql_fetch_array($query_hn)){
			$hn=chk_app_status($rs_hn[0]);
			if($hn<>''){
			//echo $rs_hn[0]."<br>";
				mysql_query("update appoint set hn='".$hn."' where cid='".$rs_hn['cid']."'");
				mysql_close($conn);
			}			
		}
		mysql_close($conn);
		echo "check OK";

	function chk_app_status($cid){	
		include("../config/conn.php");
		
		$sql="select HN FROM patients where ID_CARD='".$cid."'";
		
		//$sql="select count(DISTINCT concat(concat(PAT_RUN_HN,'/'),pat_year_hn)) from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' AND PLA_PLACECODE='".$placecode."' AND to_char(APP_DATE,'yyyy-mm-dd')='".$date_app."' AND DEL_FLAG is NULL";
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