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

mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_RsLihatBerita1 = "SELECT * FROM berita ORDER BY id_berita DESC";
$RsLihatBerita1 = mysql_query($query_RsLihatBerita1, $bappauddanpnfbengkulu) or die(mysql_error());
$row_RsLihatBerita1 = mysql_fetch_assoc($RsLihatBerita1);
$totalRows_RsLihatBerita1 = mysql_num_rows($RsLihatBerita1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Century Gothic;
}
-->
</style></head>

<body>
<table width="954" border="0" align="center" cellpadding="0" cellspacing="0">
<?php do { ?>
  <tr>
    <td align="center" valign="middle" bgcolor="#FF00FF"><h1 align="justify"><u><?php echo $row_RsLihatBerita1['judul_berita']; ?></u></h1></td>
  </tr>
  <tr>
      <td valign="top" bgcolor="#FF00FF"><div align="justify"><?php echo $row_RsLihatBerita1['isi_berita_pendek']; ?> <br /><a href="berita.php?id_berita=<?php echo $row_RsLihatBerita1['id_berita']; ?>">Baca Selengkapnya . . .</a></div></td>
    </tr>
    <tr>
      <td  height="5"valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <?php } while ($row_RsLihatBerita1 = mysql_fetch_assoc($RsLihatBerita1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($RsLihatBerita1);
?>
