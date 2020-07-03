<?php
mysql_connect("localhost", "root", "");
mysql_select_db("bappauddanpnfbengkulu");

$judul=$_POST['judul'];
$tgl = date('Y-m-d H:i:s');


if (isset($_POST['simpan'])){
 $fileName = $_FILES['image']['name'];

 $sql = "insert into upload Values (NULL, '$judul', '$fileName', '$tgl')";
 mysql_query($sql);
 
 move_uploaded_file($_FILES['image']['tmp_name'], "image/".$_FILES['image']['name']);
 echo"<script>alert('Gambar Berhasil diupload !');history.go(-1);</script>";
}

?>