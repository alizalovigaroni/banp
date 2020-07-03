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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO data_asesor_bengkulu (id_asesor, nomor_induk_asesor, nama_asesor, rumpun_asesor, asal_asesor) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_asesor'], "int"),
                       GetSQLValueString($_POST['nomor_induk_asesor'], "text"),
                       GetSQLValueString($_POST['nama_asesor'], "text"),
                       GetSQLValueString($_POST['rumpun_asesor'], "text"),
                       GetSQLValueString($_POST['asal_asesor'], "text"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($insertSQL, $bappauddanpnfbengkulu) or die(mysql_error());
  if ($Result1) echo "<script>window.alert('Data Asesor Baru Sudah ditambahkan !');</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nomor_induk_asesor:</td>
      <td><input type="text" name="nomor_induk_asesor" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_asesor:</td>
      <td><input type="text" name="nama_asesor" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rumpun_asesor:</td>
      <td><select name="rumpun_asesor">
        <option value="PAUD"<?php if (!(strcmp("PAUD", ""))) {echo "SELECTED";} ?>>PAUD</option>
        <option value="LKP"<?php if (!(strcmp("LKP", ""))) {echo "SELECTED";} ?>>LKP</option>
        <option value="PKBM"<?php if (!(strcmp("PKBM", ""))) {echo "SELECTED";} ?>>PKBM</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Asal_asesor:</td>
      <td><select name="asal_asesor">
        <option value="Kota Bengkulu"<?php if (!(strcmp("Kota Bengkulu", ""))) {echo "SELECTED";} ?>>Kota Bengkulu</option>
        <option value="Kab. Seluma"<?php if (!(strcmp("Kab. Seluma", ""))) {echo "SELECTED";} ?>>Kab. Seluma</option>
        <option value="Kab. Rejang Lebong"<?php if (!(strcmp("Kab. Rejang Lebong", ""))) {echo "SELECTED";} ?>>Kab. Rejang Lebong</option>
        <option value="Kab. Mukomuko"<?php if (!(strcmp("Kab. Mukomuko", ""))) {echo "SELECTED";} ?>>Kab. Mukomuko</option>
        <option value="Kab. Lebong"<?php if (!(strcmp("Kab. Lebong", ""))) {echo "SELECTED";} ?>>Kab. Lebong</option>
        <option value="Kab. Kepahiang"<?php if (!(strcmp("Kab. Kepahiang", ""))) {echo "SELECTED";} ?>>Kab. Kepahiang</option>
        <option value="Kab. Kaur"<?php if (!(strcmp("Kab. Kaur", ""))) {echo "SELECTED";} ?>>Kab. Kaur</option>
        <option value="Kab. Bengkulu Utara"<?php if (!(strcmp("Kab. Bengkulu Utara", ""))) {echo "SELECTED";} ?>>Kab. Bengkulu Utara</option>
        <option value="Kab. Bengkulu Tengah"<?php if (!(strcmp("Kab. Bengkulu Tengah", ""))) {echo "SELECTED";} ?>>Kab. Bengkulu Tengah</option>
        <option value="Kab. Bengkulu Selatan"<?php if (!(strcmp("Kab. Bengkulu Selatan", ""))) {echo "SELECTED";} ?>>Kab. Bengkulu Selatan</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Tambah Asesor" id="btambahasesor3"/></td>
    </tr>
  </table>
  <input type="hidden" name="id_asesor" value="" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<?php  if (isset ($_POST["btambahasesor3"])){
	echo "<script> window.location.href='?mn=asesorsu1';</script>";
}
?>
<p>&nbsp;</p>
</body>
</html>