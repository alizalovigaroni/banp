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
$query_Recordset1 = "SELECT * FROM data_asesor_bengkulu";
$Recordset1 = mysql_query($query_Recordset1, $bappauddanpnfbengkulu) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.pertama
{color:#FFF;}

body,td,th {
	font-family: Century Gothic;
}
.sd {
	text-align: center;
}
.das {
	font-weight: bold;
}
th {
    cursor: pointer;
}
-->
</style></head>

<body class="sd">
<h1><u>Data Asesor BAN PAUD dan PNF di Prov. Bengkulu</u></h1>
<table id="myTable" border="1">
  <tr>
    <th align="center" valign="middle" bgcolor="#800080" class="pertama" title="Klik untuk Sorting Data berdasarkan No" onclick="sortTable(0)"><strong>No</strong>.</th>
    <th align="center" valign="middle" bgcolor="#800080" class="pertama" title="Klik untuk Sorting Data berdasarkan Nomor Induk Asesor" onclick="sortTable(1)"><strong>Nomor Induk Asesor</strong></th>
    <th align="center" valign="middle" bgcolor="#800080" class="pertama" title="Klik untuk Sorting Data berdasarkan Nama Asesor" onclick="sortTable(2)"><strong>Nama Asesor</strong></th>
    <th align="center" valign="middle" bgcolor="#800080" class="pertama" title="Klik untuk Sorting Data berdasarkan Rumpun Asesor" onclick="sortTable(3)"><strong>Rumpun Asesor</strong></th>
    <th align="center" valign="middle" bgcolor="#800080" class="pertama" title="Klik untuk Sorting Data berdasarkan Asal Asesor" onclick="sortTable(4)"><strong>Asal Asesor</strong></th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle"><?php @$i++;echo $i ?></td>
      <td><?php echo $row_Recordset1['nomor_induk_asesor']; ?></td>
      <td><?php echo $row_Recordset1['nama_asesor']; ?></td>
      <td align="center" valign="middle"><?php echo $row_Recordset1['rumpun_asesor']; ?></td>
      <td><?php echo $row_Recordset1['asal_asesor']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
