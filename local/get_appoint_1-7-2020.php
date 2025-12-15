<?php	
	session_start();
	include("../config/conn_refer.php");

	if($_GET['q']=='new'){
		$sql="SELECT DISTINCT patients.id,
		patients.cid,
		concat(concat(concat(patients.prename,patients.ptname),' '),patients.lname) as ptname,
		hospital.hoscode5,
		date_format(appoint.date_app,'%d-%m-%Y') as dateapp,
		CASE
			when appoint.date_created is NULL THEN date_format(patients.date_create,'%d-%m-%Y %H:%i:%s')
			ELSE date_format(appoint.date_created,'%d-%m-%Y %H:%i:%s') 
		END as datecreate,
		CASE
			WHEN patients.hospcode='Regis' THEN 'ทำบัตร Online'
			ELSE hospital.HOSNAME
		END hosname,
		concat(date_format(patients.dob,'%d-%m-'),date_format(patients.dob,'%Y')+543)  as birthday,
		appoint.referout_no,
		appoint.placecode,
		appoint.placename,
		appoint.time_app,
		appoint.referout_no,
		patients.hn
		FROM patients 
		left JOIN hospital ON patients.hospcode=hospital.HOSCODE5 
		LEFT JOIN appoint ON patients.cid=appoint.cid 
		where patients.del_flag is null ";
		if($_GET['status']=='0'){
			$sql.="and (patients.hn is null or patients.hn='') ORDER BY patients.date_create desc";
		}elseif($_GET['status']<>'0'){
			$sql.="and (patients.hn is not null and patients.hn<>'') ORDER BY patients.date_create desc";
		}

		//echo $sql;
		//die();
		$data=array();
	
		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){	
			$hn=chk_hn_pmk($rs[1]);
			//echo $hn."_--".$rs['cid']."<br>";
			if($hn==''){
				array_push($data,$rs);
			}else{
				if($_GET['status']=='0'){
					$query_patients=mysql_query("update patients set hn='".$hn."',status='1' where cid='".$rs['cid']."'",$conn) or die(mysql_error());
					$query_appointwalkin=mysql_query("update appoint_walkin set hn='".$hn."' where cid='".$rs['cid']."'",$conn)  or die(mysql_error());
					$query_appoint=mysql_query("update appoint set hn='".$hn."' where del_flag<>'Y' and cid='".$rs['cid']."'",$conn)  or die(mysql_error());
					$query_patient_authen=update_patient_authen($hn,$rs['cid']);
					
				}elseif($_GET['status']=='1'){
					array_push($data,$rs);
				}
			}
		}
		//echo $sql."<br>";
		echo  json_encode($data);
		//chk_app_status('1/49');
	}elseif($_GET['q']=='dayclick'){
		$sql="SELECT count(DISTINCT appoint.cid),(select DISTINCT total_app.total_app FROM total_app WHERE total_app.placecode='".$_GET['pla']."' AND total_app.opd_exam=dayofweek('".$_GET['date_app']."')) ,(select DISTINCT total_app.time_app FROM total_app WHERE total_app.placecode='".$_GET['pla']."' AND total_app.opd_exam=dayofweek('".$_GET['date_app']."')) 
			FROM appoint
			LEFT JOIN total_app ON appoint.placecode=total_app.placecode
			WHERE appoint.del_flag <>'Y' and date_format(appoint.date_app,'%Y-%m-%d')='".$_GET['date_app']."' AND appoint.placecode='".$_GET['pla']."'";
		$data=array();
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){			
			$a['total_appoint']=$rs[0];
			$a['total']=$rs[1];
			$a['time_app']=$rs[2];			
			array_push($data,$a);
		}
		echo  json_encode($data);
	}elseif($_GET['q']=='app'){
		if($_GET['pla']==''){
			$sql="SELECT x.*,
					CASE
						WHEN x.hn_app='' OR x.hn_app is NULL THEN (select hn from patients WHERE patients.cid=x.cid AND patients.hospcode=x.user_app)
						ELSE x.hn_app
					END as hn
					FROM
					(SELECT appoint.id as appoint_id,patients.id as id,appoint.cid,appoint.hn as hn_app,appoint.ptname,appoint.placecode,appoint.placename,date_format(appoint.date_app,'%d-%m-%Y') as dateapp,appoint.time_app,hospital.HOSNAME as hosname,date_format(appoint.date_created,'%d-%m-%Y %H:%i:%s') as datecreate,appoint.referout_no,appoint.date_app ,appoint.user_app,status_app
					FROM appoint 
					LEFT JOIN patients ON appoint.cid=patients.cid AND appoint.user_app=patients.hospcode 
					left JOIN hospital ON appoint.user_app=hospital.HOSCODE5 
					where appoint.del_flag <> 'Y') x
					ORDER BY x.datecreate DESC";
		}else{
			$sql="SELECT
					x.*,
					CASE
						WHEN x.hn_app='' OR x.hn_app is NULL THEN (select hn from patients WHERE patients.cid=x.cid AND patients.hospcode=x.user_app)
						ELSE x.hn_app
					END as hn
					FROM
					(SELECT appoint.id as appoint_id,patients.id as id,appoint.cid,appoint.hn as hn_app,appoint.ptname,appoint.placecode,appoint.placename,date_format(appoint.date_app,'%d-%m-%Y') as dateapp,appoint.time_app,hospital.HOSNAME as hosname,date_format(appoint.date_created,'%d-%m-%Y %H:%i:%s') as datecreate,appoint.referout_no,appoint.date_app ,appoint.user_app,status_app
					FROM appoint 
					LEFT JOIN patients ON appoint.cid=patients.cid AND appoint.user_app=patients.hospcode 
					left JOIN hospital ON appoint.user_app=hospital.HOSCODE5 ";
			if($_GET['pla']=='0101'){
				$sql.="	where appoint.placecode in('0101','0109','0111','0112','0105','0117','0106','0110') and appoint.del_flag <>'Y') x ORDER BY x.datecreate DESC";
			}else{
				$sql.="	where appoint.placecode ='".$_GET['pla']."' and appoint.del_flag <>'Y') x ORDER BY x.datecreate DESC";
			}

		}

		$data=array();
		
		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$hn=chk_hn_pmk($rs['cid']);
			if($hn==null){
				$app_status="0";
			}else{
				$app_status=chk_app_status($hn,$rs['placecode'],$rs['date_app']);
			}
			if($app_status=="1" && $rs['status_app']==null){			
				mysql_query("update appoint set hn='".$hn."', status_app='1' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die(mysql_error());
			}
				
			//echo $app_status."<br>";
			if($_GET['app_status']=="0"){
				$a['id']=$rs['id'];
				$a['referout_no']=$rs['referout_no'];
				$a['cid']=$rs['cid'];
				$a['ptname']=$rs['ptname'];
				$a['placename']=$rs['placename'];
				$a['dateapp']=$rs['dateapp'];
				$a['time_app']=$rs['time_app'];
				$a['hosname']=$rs['hosname'];
				$a['datecreate']=$rs['datecreate'];
				$a['hn']=$hn;
				//$a['hn']=chk_hn_pmk($rs['cid']);
				$a['app_status_code']=$app_status;
				if($app_status=='1'){
					$a['app_status']='<i class="far fa-check-circle fa-2x text-success"></i>';			
				}else{
					$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
				}
				array_push($data,$a);
			}elseif($_GET['app_status']=="1"){
				if($app_status>"0"){
					$a['id']=$rs['id'];
					$a['referout_no']=$rs['referout_no'];
					$a['cid']=$rs['cid'];
					$a['ptname']=$rs['ptname'];
					$a['placename']=$rs['placename'];
					$a['dateapp']=$rs['dateapp'];
					$a['time_app']=$rs['time_app'];
					$a['hosname']=$rs['hosname'];
					$a['datecreate']=$rs['datecreate'];
					$a['hn']=$hn;
					//$a['hn']=chk_hn_pmk($rs['cid']);
					$a['app_status_code']=$app_status;
					if($app_status=='1'){
						$a['app_status']='<i class="far fa-check-circle fa-2x text-success"></i>';			
					}else{
						$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
					}
					array_push($data,$a);
				}
			}	
			
		}
		//echo $sql."<br>";
		echo  json_encode($data);
	}elseif($_GET['q']=='eventclick'){
		$sql="SELECT appoint.placename,appoint.time_app,referout_no,date_format(appoint.date_app,'%d-%m-%Y'),user_app, ptname,cid FROM appoint 
			WHERE appoint.del_flag <>'Y' and date_format(appoint.date_app,'%Y-%m-%d')='".$_GET['date_app']."' and ";
			if($_GET['pla']=='0101'){
				$sql.="	appoint.placecode in('0101','0109','0111','0112','0105','0117','0106','0110')";
			}else{
				$sql.="	appoint.placecode ='".$_GET['pla']."'";
			}
		$data=array();
		
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){			
			$hn=chk_hn_pmk($rs[6]);
			$a['ptname']=$rs[5];
			$a['placename']=$rs[0];
			$a['time_app']=$rs[1];
			$a['date_app']=$rs[3];
			$app_status=chk_app_status($hn,$_GET['pla'],$_GET['date_app']);
			if($app_status=='1'){
				$a['app_status']='<i class="far fa-check-circle fa-2x text-success"></i>';			
			}else{
				$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
			}
			array_push($data,$a);
		}
		echo  json_encode($data);
	}
	//echo  json_encode($data);
	mysql_close();

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
		$query_update_patient_authen=mysql_query("update patient_authen set hn='".$hn."' where id_card='".$cid."'",$conn_cc)  or die(mysql_error());
		//$query_update_patient_authen=mysql_query("update patient_authen set hn='5723/49' where id_card='3860800018271'",$conn_cc)  or die(mysql_error());
		if($query_update_patient_authen){
			return "1";	
		}
	}

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
	
?>