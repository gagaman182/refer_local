<?php	
	include("../config/conn_refer.php");

	if($_GET['status']=='0'){
		$sql="SELECT appoint_walkin.*,date_format(appoint_walkin.created_date,'%d-%m-%Y %H:%i') as datecreate
			from appoint_walkin 
			
			where appoint_walkin.appoint_date is null or appoint_walkin.appoint_date='' order BY appoint_walkin.created_date DESC";
	}elseif($_GET['status']=='1'){
		$sql="SELECT appoint_walkin.*,date_format(appoint_walkin.created_date,'%d-%m-%Y %H:%i') as datecreate
			from appoint_walkin 
			where appoint_walkin.appoint_date is not null or appoint_walkin.appoint_date<>'' order BY appoint_walkin.created_date DESC";
	}

	$data=array();
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$pttype=chk_nhso($rs['cid']);
		
		$a['hn']=$rs['hn'];
		$a['id']=$rs['id'];
		$a['cid']=$rs['cid'];
		$a['ptname']=$rs['ptname'];
		$a['datecreate']=$rs['datecreate'];
		$a['chif']=$rs['chif'];
		$a['appoint_date']=$rs['appoint_date'];
		$a['place']=$rs['place'];
		$a['doctor']=$rs['doctor'];
		$a['userid']=get_userid($rs['hn']);
		
		$a['pttype']=$pttype[0];
		$a['hmain']=$pttype[2];
		$a['cardid']=$pttype[1];
		$a['address']=get_address($rs['hn']);
		//echo print_r($pttype).'<br>';
		//$data[]=$rs;
		array_push($data,$a);
		//print_r($pttype)."<br>";
	}
	//echo $sql."<br>";
	echo  json_encode($data);
		//chk_app_status('1/49');
	mysql_close();

	function get_address($q){
		include("../config/conn.php");
		$sql="select TAMBON.name,DISULTS.DIST_NAME,PROVINCES.PROV_NAME FROM 
			PATIENTS 
			LEFT JOIN PROVINCES ON PATIENTS.PRO1_PROV_CODE=PROVINCES.PROV_CODE
			LEFT JOIN DISULTS ON PATIENTS.DIS_DIST_CODE=DISULTS.DIST_CODE
			LEFT JOIN TAMBON ON PATIENTS.TAMBON=TAMBON.CODE

			WHERE hn='".$q."'";
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs=oci_fetch_array($st,OCI_BOTH)){
			$result='ต.'.$rs[0].' อ.'.$rs[1].' จ.'.$rs[2];
		}
		return $result;
	}

	function get_userid($hn){
		include("../config/conn_cc.php");
		$sql_userid="select line_client_id from patient_authen where hn='".$hn."'";
		$query_userid=mysql_query($sql_userid);
		$rs_userid=mysql_fetch_array($query_userid);

		return $rs_userid['line_client_id'];
		mysql_close($conn_cc);
	}

	function chk_nhso($cid){
		$token=file_get_contents("../../nhso-check/token.txt");
		$token=explode("#",$token);

		$client = new SoapClient("http://ucws.nhso.go.th:80/ucwstokenp1/UCWSTokenP1?wsdl",
				array(
					"trace"      => 1,		// enable trace to view what is happening
					"exceptions" => 0,		// disable exceptions
					"cache_wsdl" => 0) 		// disable any caching on the wsdl, encase you alter the wsdl server
				  );
				if(!$client){
					echo "Error";
					die();
				}
				$params = array(
					'user_person_id' => $token[0],
					'smctoken' => $token[1],
					'person_id' => $cid
				);

				$result = $client->searchCurrentByPID($params);
				//$someArray = json_decode($someJSON, true);

				$return = json_decode(json_encode($result),true);


				//return $return['return'];
				//die();
				
				if($return['return']['ws_status']=='NHSO-000001'){
					if(!isset($return['return']['birthdate'])){
						$data=array('ไม่สามารถตรววจสอบสิทธิได้','-','-');
					}else{
						if($return['return']['maininscl_main']=='U'){
							$hmain='('.$return['return']['hmain'].')'.$return['return']['hmain_name'];
							$cardid=$return['return']['cardid'];
						}elseif($return['return']['maininscl_main']=='S'){
							$hmain='('.$return['return']['hmain'].')'.$return['return']['hmain_name'];
							$cardid='-';
						}else{
							$cardid='-';
							$hmain='-';
						}
						$data=array($return['return']['maininscl_name'],$cardid,$hmain);
					
					}
				}else{
					$data=array('ไม่สามารถตรววจสอบสิทธิได้','-','-');
				}
				//$data= array($return['return']);
				return $data;
	}
?>