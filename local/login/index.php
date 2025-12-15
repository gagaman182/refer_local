<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Hat-Yai Hospital</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">					
				<span class="login100-form-title p-b-20"><img src="images/hy.png" width="130"></span>                            
                <span class="login100-form-title p-b-20"><font class="text-success">HatYai Hospital</font></span>
			    <div class="wrap-input100 validate-input" id="div-user">
                    <input class="input100" type="text" name="username" id="txt-user" autocomplete="off">
                    <span class="focus-input100" data-placeholder="รหัสโรงพยาบาล 5 หลัก"></span>
			    </div>
	
			    <div class="wrap-input100 validate-input" id="div-pass">                  
                    <input class="input100" type="password" name="pass" id="txt-pass" autocomplete="off"/>
                    <span class="focus-input100" data-placeholder="รหัสผ่าน"></span>
			    </div>                                  
                              		
				<div class="container-login100-form-btn" id="div-login">
                    <div class="wrap-login100-form-btn">
			            <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" id="btn-login">Login</button>
                    </div>
	            </div>
                    
               
                <div class="row"><br></div>
                 
                
                <div class="text-center p-t-1000">
                    <span class="txt1">โรงพยาบาลหาดใหญ่&copy; 2020 </span>
                </div>
					
			</div>
		</div>                                    
    </div> <!-- class limiter-->
	                


</body>
</html>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
    <script src="../../assets/js/notify.js"></script>
<script>
 
   
$(document).ready(function(){   

});	
	

$('#btn-login').click(function(){
        var username=$('#txt-user').val();
        var password=$('#txt-pass').val();
		if(username==''){
			$("#txt-user").notify("กรุณาระบุรหัสโรงพยาบาล 5 หลัก");
			return false;
		}

		if(password==''){
			$("#txt-pass").notify("กรุณาระบุรหัสผ่าน");
			return false;
		}
		
        //alert(password);
        //console.log(username);
        //alert(date_opd);
    $.ajax({
            url: "data_authen.php",
            type: "POST",
            data: {username:username,password:password},
            success:function(data){
                //alert(data);
                console.log(data);
                if(data =='1'){
                    //alert(username);
                    window.location='../index.php';
                    //window.location=('http://localhost/Authens-hr/?idx='+username); 
                }else{
                    $("#txt-pass").notify("รหัสโรงพยาบาลหรือรหัสผ่านไม่ถูกต้อง !!!");
                    $('#txt-pass').val('');
				}
                    $('#txt-psword').val('');
			
                // bootbox.alert('Update Complate');
                //$('#table-erserv').bootstrapTable('refresh',{url : "data_all.php"});
                //$('#my-modal-update').modal('toggle'); 
            }
    });
   
}); 


</script>
