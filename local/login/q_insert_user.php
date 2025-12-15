<?php session_start();
ob_start();
//include '../config/connect.local.cc.php';
 include'../../config/connect.pis.php';
 //include '../../function/conv_date.php';

//$date_opd = date_to_eng_time($_POST['date_opd']);
//$date_return = date_to_eng($_POST['date_return']);
//$date_focus = date_to_eng($_POST['date_focus']);
$cid=$_POST['cid'];
$fstatus=$_POST['fstatus'];
$psword=$_POST['psword'];
$fullname=$_POST['fullname'];
$add_pass=md5($_POST['add_pass']);
$psword2=md5($_POST['psword']);


if($fstatus=='0'){
$sql="
    insert into user(username,uname,level)
    value('$cid','$fullname','4')
    " ;
		$query = mysql_query($sql);
                if($query){
			echo "ok";
                        setcookie("str","cook1H",time()+3600); // Expire 1 Hour
		}else{
			echo mysql_error();
		}  
}


if($_REQUEST['action']=='uppass'){
        $sql="update user set 
		password='$add_pass'
		where username='$cid' ";
		
		$query = mysql_query($sql);
                if($query){
			echo "ok";
                        $_SESSION['sess']='okk';
                        setcookie("str","cook1H",time()+3600); // Expire 1 Hour
		}else{
			echo mysql_error();
		}
}

if($_REQUEST['action']=='chk'){
    $sql_q="select * from user where (username='$cid' and password='$psword2') ";  
    $query2 = mysql_query($sql_q);
    $numrow=mysql_num_rows($query2);
    echo $numrow;
    $_SESSION['sess']='okk';
    setcookie("str","cook1H",time()+3600); // Expire 1 Hour
    
}

if($_REQUEST['action']=='chk_mobile'){

    $sql_q="SELECT * FROM card_regised WHERE ready_flag='Y' AND tel='".$_POST['mobile']."' ";  
    $d = mysql_query($sql_q);
	$rs=mysql_fetch_array($d, MYSQL_ASSOC);
	
	$numrow=mysql_num_rows($d);
   
   if($numrow==0){
		echo $numrow;   
	}else{
		echo md5($rs['cid']);
                setcookie("str","cook1H",time()+3600); // Expire 1 Hour
	}
    //echo $numrow;
    //echo $cid;
}
if($_REQUEST['action']=='chk_cid'){

    // เช็ค cid ว่ามีในระบบมั่ย    
        $sql_q="SELECT p.`name` as fname,p.lastname,max(c.card_id) max_id,c.cid,c.tel,c.del_flag,c.ready_flag 
            FROM card_regised c
            LEFT JOIN pis p ON p.cid=c.cid
            WHERE c.cid='".$_POST['cid']."' and c.del_flag is NULL";  
        
        $d = mysql_query($sql_q);
	$rs=mysql_fetch_array($d, MYSQL_ASSOC);
        
   // เช็ค cid ว่าลงทะเบียนแล้วหรือยัง
        $sql_q_u="SELECT * FROM `user` WHERE username='".$_POST['cid']."' ";  
        
        $d_u = mysql_query($sql_q_u);
	$rs_u=mysql_fetch_array($d_u, MYSQL_ASSOC);
        
        
        $fullname=$rs['fname'].' '.$rs['lastname'];
	//echo $numrow1=mysql_num_rows($d);
        //echo $numrow1;

        if($rs['cid']==''){
		echo '0';
                exit;
	}
        else if($rs_u>=1){
            	echo '01';
                exit;
        }else{
                // เช็คเบอร์ซ้ำ
                $sql_q="SELECT * FROM card_regised  WHERE tel='".$_POST['mobile']."' and ready_flag='Y' ";
                $d = mysql_query($sql_q);
                $row_mobile=mysql_num_rows($d);
                
                if($row_mobile >= 1){
                    echo 'smobile';
                    exit;
                }else{
                    echo 'conf-otp';
                // เพิ่มเบอร์โทร
                    //$sql_q="update card_regised set tel='".$_POST['mobile']."',ready_flag='Y' where card_id='".$rs['max_id']."' ";  
                    //mysql_query($sql_q);
                    //echo md5($rs['cid']);
                }    
                
                
                
                
	}

}


if($_REQUEST['action']=='update_mobile'){

    // เพิ่มเบอร์โทร
        $sql_q="update card_regised set tel='".$_POST['mobile']."',ready_flag='Y' where cid='".$_POST['cid']."' ";  
        $qr=mysql_query($sql_q);
        echo $qr;
        
        setcookie("str","cook1H",time()+3600); // Expire 1 Hour

}
?>
