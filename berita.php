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

$maxRows_Recordset1 = 1;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['id_berita'])) {
  $colname_Recordset1 = $_GET['id_berita'];
}
mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_Recordset1 = sprintf("SELECT * FROM berita WHERE id_berita = %s", GetSQLValueString($colname_Recordset1, "int"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $bappauddanpnfbengkulu) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAN PAUD DAN PNF PROVINSI BENGKULU</title>
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#form1 table tr td #MenuBar1 li a {
	font-family: Century Gothic;
}
body {
	background-image: url(image/d31b3529d783cb948fe4f924b447ea5a.jpg);
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
font-size: 16px;	
font-weight: bold;
color: blue;
}
</style>
<script type="text/javascript" src="http://subhishine.freehostia.com/shine/files/basiccalendar.js">
</script>
<style>
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
</head>

<body onload="MM_preloadImages('image/kop bap ungu.jpg')">

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

<form id="form1" name="form1" method="post" action="">
  <table width="1250" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="center"><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','image/kop banp ungu kecil.jpg',1)"><img src="image/kop banp kecil.jpg" name="Image1" width="1014" height="175" border="0" id="Image1" /></a></td>
      <td width="235" rowspan="5" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="3" align="center" bgcolor="#FFFFFF"><marquee style="border: BLUE 2px SOLID; font-weight: bold; font-size: 24px;">
      Selamat Datang di Website BAN PAUD DAN PNF PROVINSI BENGKULU
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
      <td colspan="3" align="center" bgcolor="#EEEEEE"><ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="index.php?mn=beranda">Beranda</a></li>
<li><a href="#" class="MenuBarItemSubmenu">Organisasi</a>
  <ul>
            <li><a href="index.php?mn=organisasi&amp;aksi=dasar">Dasar Hukum</a></li>
            <li><a href="index.php?mn=organisasi&amp;aksi=visimisi">Visi dan Misi</a></li>
            <li><a href="index.php?mn=organisasi&amp;aksi=profillembaga">Profil Lembaga</a></li>
            <li><a href="index.php?mn=organisasi&amp;aksi=struktur">Struktur Organisasi</a></li>
            <li><a href="index.php?mn=organisasi&amp;aksi=profilanggota">Anggota BAP PAUD dan PNF Bengkulu</a></li>
			<li><a href="index.php?mn=organisasi&amp;aksi=asesor">Asesor BAN PAUD dan PNF di Bengkulu</a></li>
  </ul>
          </li>
        <li><a href="#" class="MenuBarItemSubmenu">Akreditasi</a>
          <ul>
            <li><a href="#">Persyaratan Akreditasi</a></li>
            <li><a href="#">Alur Akreditasi</a></li>
          </ul>
        </li>
        <li><a href="index.php?mn=unduhan" class="MenuBarItemSubmenu">Unduhan</a>
          <ul>
            <li><a href="index.php?mn=unduhan&amp;aksi=skakreditasi">SK Hasil Akreditasi</a></li>
            <li><a href="index.php?mn=unduhan&amp;aksi=instrumenakreditasi">Instrumen Akreditasi</a></li>
          </ul>
        </li>
<li><a href="index.php?mn=galeri">Geleri Foto</a></li>
        <li><a href="index.php?mn=hubungikami">Hubungi Kami</a></li>
      </ul></td>
    </tr>
    <tr>
      <td rowspan="3" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="955" height="20" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="30" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
      
      <td rowspan="3" align="center" valign="top" bgcolor="#BF00FF"><table width="240" border="0">
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
          <td align="center" valign="top"></td>
        </tr>
        <tr>
          <td align="center" valign="top">&nbsp;</td>
        </tr>
      </table>
      
     
      
     
      
      
      </td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF"><table width="954" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top"><h1 align="center"><u><?php echo $row_Recordset1['judul_berita']; ?></u></h1></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><div align="justify"><?php echo $row_Recordset1['isi_berita']; ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Penulis: <?php echo $row_Recordset1['penulis_berita']; ?><br />
            <?php echo $row_Recordset1['tanggal berita']; ?></td>
        </tr>
        <?php do { ?>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table></td>
      
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" bgcolor="#0000FF">
      
      <div align="center"><font face="georgia" color="white"><strong>
        <marquee behavior="alternate" bgcolor="red" width="50%" scrollamount="7" class="dhdh">
          ver. 1.0 aliza.loviga.roni@gmail.com <a class="sundaboy" href="index.su.php">(c)</a> 2017
</marquee>
      </strong></font></div>
      
      </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
swfobject.registerObject("FlashID");
//-->
</script>
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
</body>
</html>