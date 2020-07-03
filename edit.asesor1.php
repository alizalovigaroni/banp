<?php require_once('Connections/bappauddanpnfbengkulu.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "menu.su.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.su.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE data_asesor_bengkulu SET nomor_induk_asesor=%s, nama_asesor=%s, rumpun_asesor=%s, asal_asesor=%s WHERE id_asesor=%s",
                       GetSQLValueString($_POST['nomor_induk_asesor'], "text"),
                       GetSQLValueString($_POST['nama_asesor'], "text"),
                       GetSQLValueString($_POST['rumpun_asesor'], "text"),
                       GetSQLValueString($_POST['asal_asesor'], "text"),
                       GetSQLValueString($_POST['id_asesor'], "int"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($updateSQL, $bappauddanpnfbengkulu) or die(mysql_error());
if ($Result1) echo "<script>window.alert('Data Admin yang Baru Sudah disimpan !');</script>";
  $updateGoTo = "menu.su.php?mn=asesorsu";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RsEditAsesor = "-1";
if (isset($_GET['id_asesor'])) {
  $colname_RsEditAsesor = $_GET['id_asesor'];
}
mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_RsEditAsesor = sprintf("SELECT * FROM data_asesor_bengkulu WHERE id_asesor = %s", GetSQLValueString($colname_RsEditAsesor, "int"));
$RsEditAsesor = mysql_query($query_RsEditAsesor, $bappauddanpnfbengkulu) or die(mysql_error());
$row_RsEditAsesor = mysql_fetch_assoc($RsEditAsesor);
$totalRows_RsEditAsesor = mysql_num_rows($RsEditAsesor);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SUPER USER BAP PAUD dan PNF Bengkulu</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">

ul.MenuBarHorizontal {
	width: 36em;
	margin: auto;
}
ul.MenuBarHorizontal a {
	text-align: center;
}
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

<body onload="MM_preloadImages('image/kop bap ungu.jpg')">



<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center"><a href="menu.su.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','image/kop bap ungu kecil.jpg',1)"><img src="image/kop bap kecil.jpg" name="Image1" width="1014" height="175" border="0" id="Image1" /></a></td>
      <td width="235" rowspan="5" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF"><marquee style="border: BLUE 2px SOLID; font-weight: bold; font-size: 24px;">Selamat Datang "SUPER USER" di Website BAP PAUD dan PNF Bengkulu</marquee></td>
      
    <tr>
      <td width="30" align="left" bgcolor="#FFFFFF">&nbsp;</td>
      <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF">
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
<div align="center">Selamat Datang Super User, <?php echo $_SESSION['MM_Username']; ?></div>

</td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#EEEEEE">
      <ul id="MenuBar1" class="MenuBarHorizontal">
      
        <li><a href="menu.su.php">Beranda</a></li>
        <li><a href="menu.su.php?mn=asesorsu">Asesor</a></li>
<li><a href="menu.su.php?mn=bukutamusu">Buku Tamu</a></li>
<li><a href="<?php echo $logoutAction ?>">Keluar</a></li>
      </ul></td>
    </tr>
    <tr>
      <td width="30" rowspan="5" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="20" align="center" valign="top" bgcolor="#FFFFFF"></td>
      <td width="30" rowspan="5" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td rowspan="5" align="center" valign="top" bgcolor="#BF00FF"><table width="240" border="0">
        <tr>
          <td align="center" valign="top">
            
            <body bgcolor="red" text="black" onload="waktu()">
            <div id="output3"> 
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
      <td height="20" align="center" valign="top" bgcolor="#FFFFFF"><h3><strong><u>Masukkan Data Asesor yang ingin di Ubah</u></strong></h3></td>
    </tr>
    <tr>
      <td width="955" height="20" align="center" valign="top" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF">
	  
      </td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF"><table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nomor_induk_asesor:</td>
          <td><input type="text" name="nomor_induk_asesor" value="<?php echo htmlentities($row_RsEditAsesor['nomor_induk_asesor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nama_asesor:</td>
          <td><input type="text" name="nama_asesor" value="<?php echo htmlentities($row_RsEditAsesor['nama_asesor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rumpun_asesor:</td>
          <td><select name="rumpun_asesor">
            <option value="PAUD" <?php if (!(strcmp("PAUD", htmlentities($row_RsEditAsesor['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PAUD</option>
            <option value="LKP" <?php if (!(strcmp("LKP", htmlentities($row_RsEditAsesor['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LKP</option>
            <option value="PKBM" <?php if (!(strcmp("PKBM", htmlentities($row_RsEditAsesor['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PKBM</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Asal_asesor:</td>
          <td><select name="asal_asesor">
            <option value="Kota Bengkulu" <?php if (!(strcmp("Kota Bengkulu", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kota Bengkulu</option>
            <option value="Kab. Seluma" <?php if (!(strcmp("Kab. Seluma", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Seluma</option>
            <option value="Kab. Rejang Lebong" <?php if (!(strcmp("Kab. Rejang Lebong", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Rejang Lebong</option>
            <option value="Kab. Mukomuko" <?php if (!(strcmp("Kab. Mukomuko", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Mukomuko</option>
            <option value="Kab. Lebong" <?php if (!(strcmp("Kab. Lebong", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Lebong</option>
            <option value="Kab. Kepahiang" <?php if (!(strcmp("Kab. Kepahiang", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Kepahiang</option>
            <option value="Kab. Kaur" <?php if (!(strcmp("Kab. Kaur", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Kaur</option>
            <option value="Kab. Bengkulu Utara" <?php if (!(strcmp("Kab. Bengkulu Utara", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu Utara</option>
            <option value="Kab. Bengkulu Tengah" <?php if (!(strcmp("Kab. Bengkulu Tengah", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu Tengah</option>
            <option value="Kab. Bengkulu Selatan" <?php if (!(strcmp("Kab. Bengkulu Selatan", htmlentities($row_RsEditAsesor['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu Selatan</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
        <input type="hidden" name="id_asesor" value="<?php echo $row_RsEditAsesor['id_asesor']; ?>" />
        <input type="hidden" name="MM_update" value="form1" />
      <input type="hidden" name="id_asesor" value="<?php echo $row_RsEditAsesor['id_asesor']; ?>" />
      <br />
      --oOo--<br /></td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" bgcolor="#0000FF">
      
      <div align="center"><font face="georgia" color="white"><strong>
        <marquee behavior="alternate" bgcolor="red" width="50%" scrollamount="7" class="dhdh">
          ver. 1.0 aliza.loviga.roni@gmail.com(c) 2017
</marquee>
      </strong></font></div>
      
      </td>
    </tr>
  </table>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
swfobject.registerObject("FlashID");
//-->
</script>

<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RsEditAsesor);
?>
