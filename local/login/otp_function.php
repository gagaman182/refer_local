<?php	session_start();
	function sendOTP_mail($email,$otp) {
		require_once('phpmailer/class.phpmailer.php');
		require_once('phpmailer/class.smtp.php');					
		$message_body = "รหัส OTP นี้สามารถใช้งานได้ครั้งเดียว จะหมดอายุในอีก 5 นาที OTP Number: " . $otp;			
	 	$mail = new PHPMailer();  // กำหนดตัวแปร  $mail
 		$mail->CharSet = "utf-8";
 		$mail->IsHTML(true);
   		$mail->SetFrom("computer.hatyaihospital@gmail.com", "Hat-Yai Hospital");
    	$mail->Host = "mail.bbsoft.in.th"; // กำหนดที่อยู่โฮส
    	$mail->Mailer = "smtp"; 
		$mail->Body = $message_body;
		$mail->AddAddress($email); // to Address
    	$mail->Subject = "OTP to Login"; // กำหนดหัวข้ออีเมล์
    	$mail->SMTPAuth = "true"; 
    	$mail->Host = "mail.bbsoft.in.th";
    	$mail->Username = "admin@bbsoft.in.th"; // กำหนดusername ของโฮส
    	$mail->Password = "18Boyxxx"; // กำหนด password ของโ
		$result = $mail->Send();
		return $result;
	}
		
		
	function sendOTP_phone($phone,$otp) {

		$otp="OTP Number : ".$otp;
		$url = 'http://sms-android.com/api/v1/messages/send/index.php';
		$data = array("email" => 'b.boonthap@gmail.com',"password" => 'Com3274*',"channel" => 'HY01',"number" => $phone,"message" => $otp);
		//$data_json = json_encode($data);
		$data=http_build_query($data);
  

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    $results = curl_exec( $ch );
    curl_close($ch);
    

    
	//echo $results;
	  
			$obj = json_decode($results);
			$st=$obj->success; 
			if($st=='1'){
				$status='1';	
			}else{
				$status='0';	
			}

    

			
  }
	
?>