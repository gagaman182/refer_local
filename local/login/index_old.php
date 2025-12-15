<?php session_start(); ?>
<?php  
ob_start(); 
$ssid=session_id();

?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="http://www.hatyaihospital.go.th/web/hy_ico.ico">


<!DOCTYPE html>
<html lang="en">
<link href="../vote/css/bootstrap.css" rel="stylesheet" type="text/css" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hatyai Hospital</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/autocomplete.css"  type="text/css"/>
<title>System Login</title>

		<meta charset="utf-8" />


<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 1024px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
		  display: inline-block;

        }
        .modal-lg {
          width: 900px; /* New width for large modal */
        }
		.centered {
			text-align: center;
			font-size: 0;
		}
		.centered > div {
			float: none;
			display: inline-block;
			text-align: left;
			font-size: 13px;
		}

    }
	/* กำหนด highlight */
	tr.custom--success td {
	  background-color: #3399ff !important; /*custom color here*/
	}

	/*กำหนด cursor ให้เป็นรูป pointer สำหรับ click table*/
	.table-hover tbody tr:hover > td {
    cursor: pointer;
}
</style>

</head>
<body >


<br />
<div align="center">
<img src="img/hy.png" width="30%">
</div>
<h2 align="center"><font color="#999999">
<strong>Hatyai Hospital</strong></font></h2>



    <div  class="col-md-6 col-sm-6" >
    <div class="form-group" align="center"> 
    <label id="doc_code" style="display:none">ระบุเลข ว.แพทย์</label>
    </div>
    </div>
      		
   <div class="col-md-6 col-sm-6">
   	<div class="form-group">
   	<font color="#000000" style="font-size:18px;">
    <?php 
	include'config/connect.pis.php';
	$id = $_REQUEST['id'];
	$sql="
	select *
	from pis
	where md5(cid)='$id' 
	";
	mysql_query("SET NAMES UTF8");
	$query = mysql_query($sql);
	while($rs = mysql_fetch_array($query)) {
		//echo md5($rs[15]);
		echo 'สวัสดี คุณ'.$rs[13].' '.$rs[14];
	}
	?>
    </font>
       	<input name="psword" type="text" class="form-control" id="psword" style="text-align:center" placeholder="ระบุรหัสผ่านเพื่อเข้าสู่ระบบ"/>
        <input type="hidden" name="user_code"   id="user_code"  size="10"  />       
   	</div>
   </div>
                        

        
<div class="col-md-6 col-sm-6"><div class="form-group" align="center">   
         <input name="Login" type="submit" class="btn btn-primary" value="Login" id="Login"  />
        
  </div></div>
            
    

    

    
</body>
</html>   

<script src="js/jquery.min.js"></script>
<script src="assets/js/notify.js"></script>
<script>
$('#Login').click(function(){
	$("#psword").notify("กรุณาระบุรหัสผ่าน !!!");
	
});

</script>

		