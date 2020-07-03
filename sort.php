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
$query_rsfoto = "SELECT * FROM images";
$rsfoto = mysql_query($query_rsfoto, $bappauddanpnfbengkulu) or die(mysql_error());
$row_rsfoto = mysql_fetch_assoc($rsfoto);
$totalRows_rsfoto = mysql_num_rows($rsfoto);
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<table border="1" align="center">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>image</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsfoto['id']; ?></td>
      <td><?php echo $row_rsfoto['name']; ?></td>
      <td><?php echo $row_rsfoto['image']; ?></td>
    </tr>
    <?php } while ($row_rsfoto = mysql_fetch_assoc($rsfoto)); ?>
</table>
<?php
// CLEAN FILENAME
function jin_gfile($txt) {
	$txt = preg_replace("/[^a-zA-Z0-9s.]/", "_", trim($txt));
	return $txt;
}
?>
</body>
</html>
<?php
mysql_free_result($rsfoto);
?>
