<? session_start();
$_SESSION['page']='patho';
 ob_start();  
if($_SESSION['user_id']==''){
	header("Location:chk_user/user_login.php?page=patho");
	}


?>
<?php
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear [$strHour:$strMinute:$strSeconds]";
	}
		function DateThai2($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	$strDate = "2008-08-14 13:42:44";
	?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<? //ชีเมาส์?>
<script type="text/javascript" src="../patho/js/jquery-1.4.4.min.js"></script>  
    <script type="text/javascript">  
    $(document).ready(function(){  
         $TtoolTipAjax();  
    });  
    $TtoolTipAjax=function(){//ทีทูลทิป ฟังก์ชั่น  
    $('.lnk').hover(function(e){ //Mouse Hover แอทริบิวต์ คลาส ชื่อ lnk  
    $('body').append('<div class="showTooltip"> </div>');  
    var showTooltip=$('.showTooltip');  
        $.ajax({//เรียกใช้ ajax ของ jQuery  
            url:$(this).attr('turl')+'&'+new Date().getTime(),  
            beforeSend :function(){//ก่อนส่งค่า   
                 showTooltip.html('<img src="wait.gif"/>'); //แสดงตัว loading   
              },  
            success:function(data){//ส่งค่าเสร็จสมบูรณ์ พร้อมกับผลลัพธุ์ถูกส่งกลับมา(data)  
                showTooltip.html(data);  
           }  
        });  
    var mousex = e.pageX+10 ;   
    var mousey = e.pageY;    
    var tooltipWidth = showTooltip.width();   
    var tooltipHeight = showTooltip.height();   
    var toolVisX = $(window).width() - (mousex + tooltipWidth);   
    var toolVisY = ($(window).height()+$(window).scrollTop())-(mousey+tooltipHeight);   
    if ( toolVisX < 10 ) {  mousex = e.pageX - tooltipWidth - 40;  }  
    if ( toolVisY < 10 ) {   mousey = e.pageY - tooltipHeight - 10;  }  
    showTooltip.css({ top: mousey, center: mousex,display:'none'});  
    showTooltip.slideDown('slow');  
    },function(){ //Mouse Out  
           $('.showTooltip').remove();//Remove Tooltip  
    })  
    }  
    </script>  
    <title>Pathology Report</title>  
    <style type="text/css">  
    /*ปรับสีสันของ Tooltip ได้จากคำสั่ง CSS ตรงนี้*/  
    body{  
    font-size:12px;  
 /*   font-family:Tahoma, Geneva, sans-serif;  */
    }  
    .showTooltip{  
    float:left;  
    padding:10px;  
    background:#F3F3F3;  
    border:2px solid #CFCFCF;  
    -moz-border-radius: 4px;    
    -webkit-border-radius: 4px;    
    border-radius: 4px;  
    color:#333;
     position:absolute; 
    }  
    a{  
    margin:5px;  
    color:#06C;  
    text-decoration:none;  
    }  
	.text_box {
	border:2px solid #456879;
	border-radius:10px;
	height: 30px;
	width: 100px;
	font-size: 18px;
}
    </style>  
<?
class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp;
	var $querystring;
	var $url_next;

	function Paginator()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = $this->default_ipp;
		$this->url_next = $this->url_next;
	}
	function paginate()
	{

		if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
		$this->num_pages = ceil($this->items_total/$this->items_per_page);

		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;


		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"".$this->url_next.$this->$prev_page."\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $_GET['Page'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"".$this->url_next.$i."\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($_GET['Page'] != 'All')) ? "<a class=\"paginate\" href=\"".$this->url_next.$next_page."\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" href=\"".$this->url_next.$i."\">$i</a> ";
			}
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;
		$this->high = ($_GET['ipp'] == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}

	function display_pages()
	{
		return $this->return;
	}
}
?>
<html>
<link href="../css/buttom.css" rel="stylesheet" type="text/css" />
<head>
<title>Doc paper</title>
</head>
<style type="text/css"> 
<!--
	.paginate {
	font-family: Arial, Helvetica, sans-serif;
	font-size: .7em;
	}
	a.paginate {
	border: 1px solid #000080;
	padding: 2px 6px 2px 6px;
	text-decoration: none;
	color: #000080;
	}
	h2 {
		font-size: 12pt;
		color: #003366;
		}
		
		 h2 {
		line-height: 1.2em;
		letter-spacing:-1px;
		margin: 0;
		padding: 0;
		text-align: left;
		}
	a.paginate:hover {
	background-color: #000080;
	color: #FFF;
	text-decoration: underline;
	}
	a.current {
	border: 1px solid #000080;
	font: bold .7em Arial,Helvetica,sans-serif;
	padding: 2px 6px 2px 6px;
	cursor: default;
	background:#000080;
	color: #FFF;
	text-decoration: none;
	}
	span.inactive {
	border: 1px solid #999;
	font-family: Arial, Helvetica, sans-serif;
	font-size: .7em;
	padding: 2px 6px 2px 6px;
	color: #999;
	cursor: default;
	}
-->
</style>
<style type="text/css">
body {
	background-image: url(../images/cc/cch.jpg);
}
</style>
<style type="text/css">
<!--
.Recordadmin_Odd{
background-color:#F3FBFD; 
/*	background:#FF0;*/
	color:#000000
}
.Recordadmin_Even{
	background-color:#D1E5F0; /*??*/
/*	background:#FF0;*/
	color:#000000
}
.Recordadmin_Hover{
	color:#000000;
/*background-color:#9DD8FF ;*/
background:#99FFFF;  /*   สีเมื่อเลื่อนเมาส์ */
/**/
}
body,td,th {
	font-family: tahoma;
	font-size: 14px;
}
.style1 {color: #FFFFFF}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000033;
}

.style4 {font-size: 18px}
.style5 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<body onLoad="document.form1.txtfind.focus();">
<?
    function getrowadmin_style($var, $hover=""){
	if($hover){
		if($var%2=='0'){
			$style = "class = 'Recordadmin_Even' onMouseOver='this.className=\"Recordadmin_Hover\"' onMouseOut='this.className=\"Recordadmin_Even\"'";
		}else{
			$style = "class = 'Recordadmin_Odd' onMouseOver='this.className=\"Recordadmin_Hover\"' onMouseOut='this.className=\"Recordadmin_Odd\"'";
		}
	}else{
		if($var%2=='0'){
			$style = "class = 'Recordadmin_Even'";
		}else{
			$style = "class = 'Recordadmin_Odd'";
		}
	}
	return $style;
}
include("../patho/connect.inc.php");
$objConnect = mysql_connect("localhost","root","2704") or die("Error Connect to Database");
$objDB = mysql_select_db("mydatabase");
$strSQL = "select * from patho
		where (hn = '".$_REQUEST['hn']."') and (del_flag='')

 ";
mysql_query('set names tis620');
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$Num_Rows = mysql_num_rows($objQuery);

$Per_Page = 200;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$strSQL .=" order  by id desc LIMIT $Page_Start , $Per_Page";
$objQuery  = mysql_query($strSQL);
?>
<table width="100%" border="0">
  <tr>
    <td width="50%" align="left"><font size="+4"><a href="../patho/report_search_user.php"><img src="../images/cc/patho/head.jpg" width="133" height="122" border="0"></a><img src="../patho/image/head.png" width="428" height="88"></font></td>
    <td width="50%" align="right">
    <?php
	echo '';
	 include'../patho/chk_user/session.php';
	 //echo $_POST['hn'];
	 ?>
    </td>
  </tr>
</table>
<form name="form1"  method="post">
  <table width="100%" border="0">
  <tr>
    <th height="75" colspan="12" align="center" bgcolor="#5EC6ED">   <p align="right"><strong>ค้นหา จาก HN</strong>
        <input name="hn" type="text" class="text_box" id="hn" style="text-align:center" />
        <input name="button" type="submit" class="buttom_shout" id="button" value="ค้นหา" />
   &nbsp;&nbsp;&nbsp; </p>                
    </tr>
  <tr>
    <td width="58" align="center" bgcolor="#CCCCCC"><strong>No.</strong></td>
    <td width="57" align="center" bgcolor="#CCCCCC"><strong>ID.</strong></td>
    <td width="154" height="45" align="center" bgcolor="#CCCCCC"><strong>S_Number</strong></td>
    <td width="137" align="center" bgcolor="#CCCCCC"><strong>Name</strong></td>
    <td width="102" align="center" bgcolor="#CCCCCC"><strong>HN</strong></td>
    <td width="150" align="center" bgcolor="#CCCCCC"><strong>Place</strong></td>
    <td width="72" align="center" bgcolor="#CCCCCC"><strong>Date received</strong></td>
    <td width="80" align="center" bgcolor="#CCCCCC"><strong>Date of report</strong></td>
    <td width="59" align="center" bgcolor="#CCCCCC"><strong>Approve</strong></td>
    <td width="80" align="center" bgcolor="#CCCCCC"><strong>Type</strong></td>
    <td width="101" align="center" bgcolor="#CCCCCC"><strong>Print PDF</strong></td>
    <td width="79" align="center" bgcolor="#CCCCCC"><strong>Print A4</strong></td>
    </tr>
    <script language="JavaScript" type="text/JavaScript">
function sent(id1,id2,id3){
//	window.location='index.php?total=total&hn='+id1+'&opd_no='+id2;
	window.open("report_view_user.php?id="+id1+"&pl="+id2+"&hn="+id3);
//	window.location='product1.php?ค่าที่ต้องการส่ง=$n';
	}
</script>  
<?
$i=1;
while($fa= mysql_fetch_array($objQuery))
{
?>
  <tr  <?php echo getrowadmin_style($i, "Y");?> >
    <td width="58" align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')" ><?=$i++?></td>
    <td width="57" align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><?= $fa['id']?></td>
   <td width="154" height="26"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')" ><?= $fa['s_number']?></td>
    <td  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><?= $fa['name']?></td>
    <td  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><?= $fa['hn']?></td>
    <td  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><?= $fa['place']?></td>
    <td align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><? echo date('d/m/Y',strtotime($fa['date_r'])); ?></td>
    <td align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><? echo date('d/m/Y',strtotime($fa['date'])); ?></td>
    <td align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')"><?= $fa['appr']?></td>
    <td align="center"  onClick="sent('<?=$fa['id']?>','<?=$fa['pl']?>','<?=$fa['hn']?>')">
	<? if($fa['pl']=='O'){
		echo 'OPD';
		}if($fa['pl']=='I'){
			echo 'IPD';
			}if($fa['pl']=='P'){
				echo 'PSU';
				}
		?>
    </td>
    <td align="center">
    <a  href="../patho/pdf_A4.php?sn=<?= $fa['s_number']?>&pl=<?= $fa['pl']  ?>&hn=<?= $fa['hn']  ?>&id=<?=$fa['id']?>" target="_blank" >
    <img src="../patho/image/pdflogo.png" width="32" height="32" border="0">
    </a>
    </td>
    <td align="center">
    <a  href="../patho/report_view_user.php?sn=<?= $fa['s_number']?>&pl=<?= $fa['pl']  ?>&hn=<?= $fa['hn']  ?>&id=<?=$fa['id']?>" target="_blank" >
    <img src="../images/cc/png_image/apps/klpq.png" width="32" height="32" border="0" />
    </a>
    </td>
    </tr>
<?
}
?>
</table>
</form>
<br>
<? echo $Num_Rows;?> Record 

<?

$pages = new Paginator;
$pages->items_total = $Num_Rows;
$pages->mid_range = 10;
$pages->current_page = $Page;
$pages->default_ipp = $Per_Page;
$pages->url_next = $_SERVER["PHP_SELF"]."?QueryString=value&Page=";

$pages->paginate();

echo $pages->display_pages()
?>		

<?
mysql_close($objConnect);
?>
</body>
</html>
<?php 
echo '';
include '../patho/menu_foot.php';
?>
