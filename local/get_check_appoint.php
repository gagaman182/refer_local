<?php	
	include("../config/conn.php");
	$data=array();
	$hn=explode("/",$_GET['hn']);
	$run_hn=$hn[0];
	$year_hn=$hn[1];
	$sql="select
	concat(concat(DATE_DBFS.PAT_RUN_HN,'/'),DATE_DBFS.PAT_YEAR_HN) as hn,
	PLACES.PLACECODE,
	PLACES.HALFPLACE,
	to_char(DATE_DBFS.APP_DATE,'dd-mm-yyyy') date_app,
	DATE_DBFS.APPOINT_NAME,
	concat(concat(concat(DOC_DBFS.PRENAME,DOC_DBFS.NAME),' '),DOC_DBFS.SURNAME) as doc_name,
	to_char(DATE_DBFS.DATE_CREATED,'dd-mm-yyyy hh24:mi') as datecreate
	from DATE_DBFS 
	LEFT JOIN DOC_DBFS ON DATE_DBFS.DD_DOC_CODE=DOC_DBFS.DOC_CODE
	INNER JOIN PLACES ON DATE_DBFS.PLA_PLACECODE=PLACES.PLACECODE

	WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' and to_char(DATE_DBFS.APP_DATE,'yyyy-mm-dd') >= to_char(sysdate,'yyyy-mm-dd')
	ORDER BY
	DATE_DBFS.DATE_CREATED DESC";
	set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			$data[]=$rs_pmk;
		}
		
	echo  json_encode($data);
	oci_close($con);

		
?>