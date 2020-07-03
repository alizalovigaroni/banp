<?php require_once('Connections/bappauddanpnfbengkulu.php'); ?>
<?php
@$hasilkalimat=$_POST['isi_berita'];
@$kalimatpendek=substr($hasilkalimat, 0,150);
@$now=$_GET['now()'];
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO berita (id_berita, judul_berita, isi_berita, isi_berita_pendek, `tanggal berita`, penulis_berita) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_berita'], "int"),
                       GetSQLValueString($_POST['judul_berita'], "text"),
                       GetSQLValueString($_POST['isi_berita'], "text"),
                       GetSQLValueString(@$kalimatpendek, "text"),
                       GetSQLValueString(@$now, "date"),
                       GetSQLValueString($_POST['penulis_berita'], "text"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($insertSQL, $bappauddanpnfbengkulu) or die(mysql_error());
    if ($Result1) echo "<script>window.alert('Berita Baru Anda telah disimpan!');</script>";
}
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
  <h2><u><strong>Masukkan berita baru yang ingin ditambahkan </strong></u></h2>
</div>
<div align="center"><font color="blue">
  Pastikan untuk menambahkan kode "< /br>" untuk setiap baris baru yang dimasukkan kedalam isi berita!!!
  </font>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul Berita:</td>
      <td><input type="text" name="judul_berita" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Isi Berita:</td>
      <td><textarea name="isi_berita" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis Berita:</td>
      <td><input type="text" name="penulis_berita" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Tambahkan Berita" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_berita" value="" />
  <input type="hidden" name="isi_berita_pendek" value="" />
  <input type="hidden" name="tanggal_berita" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>