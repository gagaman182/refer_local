<?php
	//header('Content-Type: application/json');

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://192.168.99.225/webapp/moph-refer/backend/get_refers.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		   "refer_id" : "'.$_POST['refer_id'].'" 
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
	));
	$result=curl_exec($curl) or die(curl_error($curl));
	$return =  json_decode($result,true);
	echo json_encode($return);
	curl_close($curl);
	?>