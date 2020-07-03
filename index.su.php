<?php require_once('Connections/bappauddanpnfbengkulu.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "menu.su.php";
  $MM_redirectLoginFailed = "index.su.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  
  $LoginRS__query=sprintf("SELECT username_admin, password FROM login_admin WHERE username_admin=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $bappauddanpnfbengkulu) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAP PAUD dan PNF Bengkulu</title>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<style type="text/css">
<!--
#form1 table tr td #MenuBar1 li a {
	font-family: Century Gothic;
}
body {
	background-image: url(image/d31b3529d783cb948fe4f924b447ea5aqqqqq.jpg);
	background-repeat: repeat;
	text-align: left;
	}
-->
</style>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


// 1 detik = 1000 
                                window.setTimeout("waktu()",1000);   
                                function waktu() {    
                                    var tanggal = new Date();   
                                    setTimeout("waktu()",1000);   
                                   document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds(); 
                               } 
//-->
</script>
<style type="text/css">
a.sundaboy:link {color:#FFFFFF; text-decoration:none;}
a.sundaboy:visited {color:#0000FF;}
a.sundaboy:hover {color:#FF0000;}
.main {
width:200px;
border:1px solid black;
}
.month {
background-color:black;
font:bold 16px Century Gothic;
color:white;
}
.daysofweek {
background-color:gray;
font:bold 12px Century Gothic;
color:white;
}
.days {
font-size: 12px;
font-family:Century Gothic;
color:black;
background-color: white;
padding: 2px;
}
.days #today{
font-weight: bold;
color: blue;
}
body,td,th {
	font-family: Century Gothic;
}
</style>
<script type="text/javascript" src="http://subhishine.freehostia.com/shine/files/basiccalendar.js">
</script>
</head>

<body background="image/slide/IMG-20170603-WA0007.jpg" onload="MM_preloadImages('image/kop bap ungu.jpg')">



<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center"><a href="index.su.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','image/kop banp ungu kecil.jpg',1)"><img src="image/kop banp kecil.jpg" name="Image1" width="1014" height="175" border="0" id="Image1" /></a></td>
      <td width="235" rowspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF"><marquee style="border: BLUE 2px SOLID; font-weight: bold; font-size: 24px;">
          Selamat Datang "SUPER USER" di Website BAN PAUD DAN PNF PROVINSI BENGKULU
      </marquee></td>
      
    <tr>
      <td width="30" align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="2" align="left" bgcolor="#FFFFFF">
	  <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo date("l, d F Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');

$jam=date("H:i:s");

$a = date ("H");
if (($a>=5) && ($a<=11)){
echo "<b>, Selamat Pagi !!</b>";
}
else if(($a>11) && ($a<=15))
{
echo "<b>, Selamat Siang !!</b>";}
else if (($a>15) && ($a<=18)){
echo "<b>, Selamat Sore !!</b>";}
else { echo "<b> ,Selamat Malam !!</b>";}

?>
</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="955" align="center" valign="top" bgcolor="#FFFFFF">
      
        <table width="200" border="0">
          <tr>
            <td colspan="3" align="center" valign="top" bgcolor="#0033FF"><img src="image/images/gear-1636119_960_720.png" width="950" height="280" alt="rodagigi" /></td>
          </tr>
          <tr>
            <td width="471"><div align="right">Username</div></td>
            <td width="10">:</td>
            <td width="467"><label>
              <input type="text" name="username" id="username" />
            </label></td>
          </tr>
          <tr>
            <td><div align="right">Password</div></td>
            <td>:</td>
            <td><label>
              <input type="password" name="password" id="password" />
            </label></td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="middle"><label>
              <input type="submit" name="login" id="login" value="LOG IN" />
              <input type="submit" name="reset" id="reset" value="Reset" />
            </label></td>
          </tr>
      </table></td>
      <td width="30" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      
      <td align="center" valign="top" bgcolor="#BF00FF"><table width="240" border="0">
        <tr>
          <td align="center" valign="top">
          
<body bgcolor="red" text="black" onload="waktu()">
<div id="output"> 
</div>
          
          </td>
        </tr>
        <tr>
          <td align="center" valign="top">
          
<script type="text/javascript">

var todaydate=new Date()
var curmonth=todaydate.getMonth()+1 //get current month (1-12)
var curyear=todaydate.getFullYear() //get current year

document.write(buildCal(curmonth ,curyear, "main", "month", "daysofweek", "days", 1));
</script>           
          
          </td>
        </tr>
        <tr>
          <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="top">&nbsp;</td>
        </tr>
      </table>
    
      </td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" bgcolor="#0000FF">
      
      <div align="center"><font face="georgia" color="white"><strong>
        <marquee behavior="alternate" bgcolor="red" width="50%" scrollamount="7" class="dhdh">
          ver. 1.0 <a class="sundaboy" href="index.php">aliza.loviga.roni@gmail.com</a> (c) 2017
</marquee>
      </strong></font></div>
      
      </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</body>
</html>