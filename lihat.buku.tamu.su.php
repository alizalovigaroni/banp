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
$query_Recordset1 = "SELECT * FROM buku_tamu";
$Recordset1 = mysql_query($query_Recordset1, $bappauddanpnfbengkulu) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
#form1 p {
	text-align: center;
	font-weight: bold;
}
body,td,th {
	font-family: Century Gothic;
}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h2 align="center"><u>Daftar Buku Tamu Website BAP PAUD dan PNF Bengkulu  </u></h2>
  <table id="myTable" border="1" align="center">
    <tr>
      <th align="center" valign="middle" onclick="sortTable(0)" class="pertama" title="Klik untuk Sorting Data berdasarkan No" bgcolor="#0033FF"><strong>No.</th>
      <th align="center" valign="middle" onclick="sortTable(1)" class="pertama" title="Klik untuk Sorting Data berdasarkan Nama Tamu" bgcolor="#0033FF"><strong>Nama Tamu</th>
      <th align="center" valign="middle" onclick="sortTable(2)" class="pertama" title="Klik untuk Sorting Data berdasarkan email tamu" bgcolor="#0033FF"><strong>e-mail Tamu</th>
      <th align="center" valign="middle" onclick="sortTable(3)" class="pertama" title="Klik untuk Sorting Data berdasarkan Komentar Tamu" bgcolor="#0033FF"><strong>Komentar Tamu</th>
      <th align="center" valign="middle" class="pertama" bgcolor="#0033FF"><strong>Hapus</th>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center" valign="middle"><?php @$i++;echo $i ?></td>
        <td><?php echo $row_Recordset1['nama_tamu']; ?></td>
        <td><?php echo $row_Recordset1['email_tamu']; ?></td>
        <td><?php echo $row_Recordset1['komentar_tamu']; ?></td>
        <td align="center" valign="middle"><a href="hapus.buku.tamu.php?id_buku_tamu=<?php echo $row_Recordset1['id_buku_tamu']; ?>"onClick="return confirm ('Anda yakin ingin menghapus data buku tamu tersebut?')"><img src="image/icon/b_drop.png" width="16" height="16" alt="hapus" /></a></td>
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
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
