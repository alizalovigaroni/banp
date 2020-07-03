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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE berita SET judul_berita=%s, isi_berita=%s, isi_berita_pendek=%s, penulis_berita=%s WHERE id_berita=%s",
                       GetSQLValueString($_POST['judul_berita'], "text"),
                       GetSQLValueString($_POST['isi_berita'], "text"),
                       GetSQLValueString(@$kalimatpendek, "text"),
                       GetSQLValueString($_POST['penulis_berita'], "text"),
                       GetSQLValueString($_POST['id_berita'], "int"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($updateSQL, $bappauddanpnfbengkulu) or die(mysql_error());
  if ($Result1) echo "<script>window.alert('Data Admin yang Baru Sudah disimpan !');</script>";
  $updateGoTo = "menu.su.php?mn=berita&aksi=lihatberitasu";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rseditberita = "-1";
if (isset($_GET['id_berita'])) {
  $colname_rseditberita = $_GET['id_berita'];
}
mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_rseditberita = sprintf("SELECT * FROM berita WHERE id_berita = %s", GetSQLValueString($colname_rseditberita, "int"));
$rseditberita = mysql_query($query_rseditberita, $bappauddanpnfbengkulu) or die(mysql_error());
$row_rseditberita = mysql_fetch_assoc($rseditberita);
$totalRows_rseditberita = mysql_num_rows($rseditberita);
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
<h1 align="center"><u>Edit Berita BAP PAUD dan PNF Bengkulu </u></h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Judul_berita:</td>
      <td><input type="text" name="judul_berita" value="<?php echo htmlentities($row_rseditberita['judul_berita'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Isi_berita:</td>
      <td><textarea name="isi_berita" cols="50" rows="5"><?php echo htmlentities($row_rseditberita['isi_berita'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Penulis_berita:</td>
      <td><input type="text" name="penulis_berita" value="<?php echo htmlentities($row_rseditberita['penulis_berita'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Edit Berita" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_berita" value="<?php echo $row_rseditberita['id_berita']; ?>" />
  <input type="hidden" name="isi_berita_pendek" value="<?php echo htmlentities($row_rseditberita['isi_berita_pendek'], ENT_COMPAT, 'utf-8'); ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_berita" value="<?php echo $row_rseditberita['id_berita']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rseditberita);
?>
