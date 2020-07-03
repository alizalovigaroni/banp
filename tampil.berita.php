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
$query_retampilberita = "SELECT * FROM berita ORDER BY id_berita DESC";
$retampilberita = mysql_query($query_retampilberita, $bappauddanpnfbengkulu) or die(mysql_error());
$row_retampilberita = mysql_fetch_assoc($retampilberita);
$totalRows_retampilberita = mysql_num_rows($retampilberita);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php	

@$hasilkalimat=(@$row_retampilberita['isi_berita']);
@$kalimatpendek=substr($hasilkalimat, 0,15)

?>
<body>
<table border="1" rules="none">
  <?php do { ?>
    <tr>
      <td align="center" valign="middle"><h1><u><?php echo $row_retampilberita['judul_berita']; ?></u></h1></td>
    </tr>
    <tr>
      <td align="left" valign="top">penulis: <?php echo $row_retampilberita['penulis_berita']; ?><br />        <?php echo $row_retampilberita['tanggal berita']; ?></td>
    </tr>
    <tr>
      <td valign="top"><?php echo $row_retampilberita['isi_berita']; ?>
      <?php

echo "$kalimatpendek";
?></td>
    </tr>
    <?php } while ($row_retampilberita = mysql_fetch_assoc($retampilberita)); ?>
</table>
<br />
sd<br />
</body>
</html>
<?php
mysql_free_result($retampilberita);
?>
