<?php session_start();

$success = "";
$error_message = "";
include '../../config/connect_web_i.php';
$mobile=$_POST['mobile'];

if($_REQUEST['ac']=='send_mobile'){
	if(!empty($mobile)) {

		// generate OTP
		$otp = rand(100000,999999);
		$_SESSION['otp']=$otp;
		
		// Send OTP
		$otp="OTP Number : ".$otp;
		$url = 'http://sms-android.com/api/v1/messages/send/index.php';
		$data = array("email" => 'b.boonthap@gmail.com',"password" => 'Com3274*',"channel" => 'HY01',"number" => $mobile,"message" => $otp);
		$data=http_build_query($data);

   			$ch = curl_init();
    		curl_setopt( $ch, CURLOPT_URL, $url );
    		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    		curl_setopt( $ch, CURLOPT_POST, true );
    		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    		$results = curl_exec( $ch );
    		curl_close($ch);
   
	  
			$obj = json_decode($results);
			$st=$obj->success; 
			if($st=='1'){
				$status='1';	
			}else{
				$status='0';	
			}
			
		if($status == '1') {
			$result = mysqli_query($mysqli,"INSERT INTO otp_expiry(otp,is_expired,create_at,mobile) VALUES ('" .$_SESSION['otp']. "', 0,now(),'".$mobile."')");
			$current_id = mysqli_insert_id($mysqli);
			if(!empty($current_id)) {
				//echo $success="ส่ง OTP เรียบร้อยแล้ว";
				echo $status=1;
			}
		}else{	
				//echo $error_message = "ระบบส่ง SMS ขัดข้องกรุณาติดต่อ Admin!";
				echo $status =0;
		}

	}
}

//Check OTP
if($_REQUEST['ac']=='send_otp'){
	
	$result = mysqli_query($mysqli,"SELECT * FROM otp_expiry WHERE otp='" . $_POST["otp"] . "' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 5 MINUTE)");
	$count  = mysqli_num_rows($result);
	if(!empty($count)) {
		$result = mysqli_query($mysqli,"UPDATE otp_expiry SET is_expired = 1 WHERE otp = '" . $_POST["otp"] . "'");
		//echo $success ='OK ผ่าน';	
		echo $success =1;	
		$_SESSION['sess']=1;
	} else {
		//echo $success ='รหัส OTP ไม่ถูกต้อง';
		echo $success =0;	
	}	
	
}

?>