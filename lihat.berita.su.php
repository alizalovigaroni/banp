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
$query_rslihatberit = "SELECT * FROM berita ORDER BY `tanggal berita` DESC";
$rslihatberit = mysql_query($query_rslihatberit, $bappauddanpnfbengkulu) or die(mysql_error());
$row_rslihatberit = mysql_fetch_assoc($rslihatberit);
$totalRows_rslihatberit = mysql_num_rows($rslihatberit);
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
<div align="center">
  <h1><u>Daftar Berita BAP PAUD dan PNF Bengkulu
  </u></h1>
</div>
<br />
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" valign="middle">
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>No.</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Tanggal Berita</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Judul Berita</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Isi Berita</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Penulis Berita</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Edit</strong></th>
    <th align="center" valign="middle" bgcolor="#99CC00"><strong>Hapus</strong></th>
  </tr>
  <?php do { ?>
  <tr>
    <td align="center" valign="middle"><?php @$i++;echo $i ?></td>
    <td><?php echo $row_rslihatberit['tanggal berita']; ?></td>
    <td><?php echo $row_rslihatberit['judul_berita']; ?></td>
    <td><?php echo $row_rslihatberit['isi_berita']; ?></td>
    <td><?php echo $row_rslihatberit['penulis_berita']; ?></td>
    <td align="center" valign="middle"><a href="edit.berita.php?id_berita=<?php echo $row_rslihatberit['id_berita']; ?>"><img src="image/icon/b_edit.png" width="16" height="16" alt="editberita" /></td>
    <td align="center" valign="middle"><a href="hapus.berita.php?id_berita=<?php echo $row_rslihatberit['id_berita']; ?>"onClick="return confirm ('Anda yakin ingin menghapus Berita tersebut?')"><img src="image/icon/b_drop.png" width="16" height="16" alt="hapusberita" /></td>
  </tr>
  <?php } while ($row_rslihatberit = mysql_fetch_assoc($rslihatberit)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rslihatberit);
?>
