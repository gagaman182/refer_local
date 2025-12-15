<?php
	include("../config/conn_refer.php");
		// update hn จาก HIS
		//$sql_hn="SELECT referout_no,cid,user_app,(select hn from patients WHERE patients.cid=appoint.cid AND patients.hospcode=appoint.user_app) as hn_patients FROM appoint WHERE (del_flag ='' or del_flag is NULL ) AND (hn ='' or hn is NULL)";
		$sql_hn="SELECT DISTINCT patients.cid FROM patients where patients.del_flag is null and (patients.hn is null or patients.hn='')";
		$query_hn=mysql_query($sql_hn) or die(mysql_error());
		while($rs_hn=mysql_fetch_array($query_hn)){
			$hn=chk_hn_pmk($rs_hn['cid']);
			
			if($hn<>''){
				//mysql_query("update appoint set hn='".$hn."' where referout_no='".$rs_hn['referout_no']."' and cid='".$rs_hn['cid']."'") or die(mysql_error());	
				mysql_query("update appoint set hn='".$hn."' where cid='".$rs_hn['cid']."'") or die(mysql_error());	
				mysql_query("update patients set hn='".$hn."' where cid='".$rs_hn['cid']."'") or die(mysql_error());	
				update_patient_authen($hn,$rs_hn['cid']);			
			}
		}
		
		// update สถานะลงนัดใน HIS
		$sql="SELECT DISTINCT referout_no,hn,status_app,refer_appoint,visit_appoint,date_app,placecode_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode WHERE hn<>'' and (appoint.del_flag ='' or appoint.del_flag is NULL ) AND status_app is null AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$app_status=chk_app_status($rs['hn'],$rs['placecode_main'],$rs['date_app']);	
			//echo $rs['hn'].'-app_status='.$app_status."<br>";
			if($app_status=="1"){			
				mysql_query("update appoint set status_app='1' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die(mysql_error());
			}
		}		
		// update สถานะลงรับ refer ใน HIS
		$sql="SELECT DISTINCT referout_no FROM appoint WHERE refer_appoint is NULL AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$refer_status=chk_refer_status($rs['referout_no']);
			if($refer_status=="1"){			
				mysql_query("update appoint set refer_appoint='1' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die(mysql_error());
				//echo "update refer=".$rs['referout_no'];
			}

		}
		
		// update สถานะการ visit บัตรใน HIS
		$sql="SELECT DISTINCT referout_no,hn,status_app,refer_appoint,visit_appoint,date_app,placecode_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode WHERE hn<>'' and (appoint.del_flag ='' or appoint.del_flag is NULL ) AND visit_appoint is null AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$visit_status=chk_visit_status($rs['hn'],$rs['date_app'],$rs['placecode_main']);				
			if($visit_status=="1"){			
				mysql_query("update appoint set visit_appoint='1' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die(mysql_error());
			}

		}

		echo "check OK";
	
	mysql_close($conn);

	function chk_app_status($hn,$placecode,$date_app){	
		include("../config/conn.php");
		$hn=explode("/",$hn);
		$run_hn=$hn[0];
		$year_hn=$hn[1];
		/*$sql="SELECT CASE
			WHEN (x.DEL_FLAG='Y' OR x.DELay_FLAG='Y') AND x.HN IS NOT NULL THEN '2'	
			WHEN (x.DEL_FLAG IS null OR x.DELAY_FLAG IS NULL) AND x.HN IS NOT NULL THEN '1'
			END
			FROM
			(select DELAY_FLAG,del_flag ,concat(concat(PAT_RUN_HN,'/'),pat_year_hn) as HN from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' AND PLA_PLACECODE='".$placecode."' AND to_char(APP_DATE,'yyyy-mm-dd')='".$date_app."') x";
		*/

		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT CASE
			WHEN (x.DEL_FLAG='Y' OR x.DELay_FLAG='Y') AND x.HN IS NOT NULL THEN '2'	
			WHEN (x.DEL_FLAG IS null OR x.DELAY_FLAG IS NULL) AND x.HN IS NOT NULL THEN '1'
			END
			FROM
			(select DELAY_FLAG,del_flag ,concat(concat(PAT_RUN_HN,'/'),pat_year_hn) as HN from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' AND to_char(APP_DATE,'yyyy-mm-dd')='".$date_app."') x";
		
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

	function chk_visit_status($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		//$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND OPD_VISIT_TYPE='D' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND PLA_PLACECODE='".$placecode."'";

		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND OPD_VISIT_TYPE='D' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_visit_mark_yn($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		//$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND OPD_VISIT_TYPE='D' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND PLA_PLACECODE='".$placecode."'   AND OPD_WAREHOUSE.MARK_YN='Y'";
		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND OPD_WAREHOUSE.MARK_YN='Y'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_hn_pmk($cid){
		//$hn='';
		include("../config/conn.php");
		$sql_pmk="select hn from patients where id_card='".$cid."'";
		$st = oci_parse($con,$sql_pmk);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			return $rs[0];
		}
		
		oci_close($con);
	}

	function update_patient_authen($hn,$cid){
		include("../config/conn_cc.php");
		$query_update_patient_authen=mysql_query("update patient_authen set hn='".$hn."' where id_card='".$cid."'")  or die(mysql_error());
		//$query_update_patient_authen=mysql_query("update patient_authen set hn='5723/49' where id_card='3860800018271'",$conn_cc)  or die(mysql_error());
		if($query_update_patient_authen){
			return "1";	
		}
		mysql_close($conn_cc);
	}
?>