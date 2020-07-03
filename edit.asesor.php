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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE data_asesor_bengkulu SET nomor_induk_asesor=%s, nama_asesor=%s, rumpun_asesor=%s, asal_asesor=%s WHERE id_asesor=%s",
                       GetSQLValueString($_POST['nomor_induk_asesor'], "text"),
                       GetSQLValueString($_POST['nama_asesor'], "text"),
                       GetSQLValueString($_POST['rumpun_asesor'], "text"),
                       GetSQLValueString($_POST['asal_asesor'], "text"),
                       GetSQLValueString($_POST['id_asesor'], "int"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($updateSQL, $bappauddanpnfbengkulu) or die(mysql_error());
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_asesor'])) {
  $colname_Recordset1 = $_GET['id_asesor'];
}
mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_Recordset1 = sprintf("SELECT * FROM data_asesor_bengkulu WHERE id_asesor = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $bappauddanpnfbengkulu) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
      <td><input type="text" name="nomor_induk_asesor" value="<?php echo htmlentities($row_Recordset1['nomor_induk_asesor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama_asesor:</td>
      <td><input type="text" name="nama_asesor" value="<?php echo htmlentities($row_Recordset1['nama_asesor'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rumpun_asesor:</td>
      <td><select name="rumpun_asesor">
        <option value="PAUD" <?php if (!(strcmp("PAUD", htmlentities($row_Recordset1['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PAUD</option>
        <option value="LKP" <?php if (!(strcmp("LKP", htmlentities($row_Recordset1['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LKP</option>
        <option value="PKBM" <?php if (!(strcmp("PKBM", htmlentities($row_Recordset1['rumpun_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>PKBM</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Asal_asesor:</td>
      <td><select name="asal_asesor">
        <option value="Kota Bengkulu" <?php if (!(strcmp("Kota Bengkulu", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kota Bengkulu</option>
        <option value="Kab. Seluma" <?php if (!(strcmp("Kab. Seluma", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Seluma</option>
        <option value="Kab. Rejang Lebong" <?php if (!(strcmp("Kab. Rejang Lebong", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Rejang Lebong</option>
        <option value="Kab. Mukomuko" <?php if (!(strcmp("Kab. Mukomuko", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Mukomuko</option>
        <option value="Kab. Lebong" <?php if (!(strcmp("Kab. Lebong", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Lebong</option>
        <option value="Kab. Kepahiang" <?php if (!(strcmp("Kab. Kepahiang", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Kepahiang</option>
        <option value="Kab. Kaur" <?php if (!(strcmp("Kab. Kaur", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Kaur</option>
        <option value="Kab. Bengkulu Utara" <?php if (!(strcmp("Kab. Bengkulu Utara", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu Utara</option>
        <option value="Kab. Bengkulu  Tengah" <?php if (!(strcmp("Kab. Bengkulu  Tengah", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu  Tengah</option>
        <option value="Kab. Bengkulu Selatan" <?php if (!(strcmp("Kab. Bengkulu Selatan", htmlentities($row_Recordset1['asal_asesor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kab. Bengkulu Selatan</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="id_asesor" value="<?php echo $row_Recordset1['id_asesor']; ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_asesor" value="<?php echo $row_Recordset1['id_asesor']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
