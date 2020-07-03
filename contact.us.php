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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO buku_tamu (nama_tamu, email_tamu, komentar_tamu) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['komentar'], "text"));

  mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
  $Result1 = mysql_query($insertSQL, $bappauddanpnfbengkulu) or die(mysql_error());
    if ($Result1) echo "<script>window.alert('Komentar Anda telah disimpan!');</script>";
}

mysql_select_db($database_bappauddanpnfbengkulu, $bappauddanpnfbengkulu);
$query_rsbukutamu = "SELECT * FROM buku_tamu";
$rsbukutamu = mysql_query($query_rsbukutamu, $bappauddanpnfbengkulu) or die(mysql_error());
$row_rsbukutamu = mysql_fetch_assoc($rsbukutamu);
$totalRows_rsbukutamu = mysql_num_rows($rsbukutamu);
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Century Gothic;
}

* {
    box-sizing: border-box;
}

/* Style inputs */
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

/* Style the container/contact section */
.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 10px;
}

/* Create two columns that float next to eachother */
.column {
    float: left;
    width: 50%;
    margin-top: 6px;
    padding: 20px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .column, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
body,td,th {
	font-family: Century Gothic;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body>



<div class="container">
  <div style="text-align:center">
    <h2>Hubungi Kami</h2>
    <p>Bantu kami untuk lebih baik, tinggalkan pesan:</p>
  </div>
  <div class="row">
    <div class="column">
      <div id="map" style="width:100%;height:500px"></div>
    </div>
    <div class="column">
      <form method="POST" name="form" action="<?php echo $editFormAction; ?>">
        <label for="fname">
          <div align="left">Nama:</div>
        </label>
        <div align="left">
          <input type="text" id="nama" name="nama" placeholder="Nama anda..">
        </div>
        <label for="lname">
          <div align="left">Alamat e-mail:</div>
        </label>
        <input type="text" id="email" name="email" placeholder="email anda..">
        <label for="subject">
          <div align="left">Pesan:</div>
        </label>
        <div align="left">
          <textarea id="komentar" name="komentar" placeholder="Tulis sesuatu.." style="height:170px"></textarea>
          <input type="submit" value="Kirim Komentar" title="Kirim Komentar"  id="butonmasukkandata">
        </div>
        <input type="hidden" name="MM_insert" value="form">
      </form>
    </div>
  </div>
</div>

<script>
// Initialize google maps
function myMap() {
  var myCenter = new google.maps.LatLng(-3.792308,102.250874);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyCVGNg5MNxglM1sEjmWI6E7V7W5ATeE4&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
<?php
mysql_free_result($rsbukutamu);
?>
