<?php
 
 mysql_connect("localhost", "root", "");
 mysql_select_db("bappauddanpnfbengkulu");

 $kueri = mysql_query(" SELECT * FROM upload");
 while ($baris=mysql_fetch_array($kueri))
 {
  
  $formatted = date('d-M-Y H:i:s', strtotime($baris['Waktu']));
  echo $formatted;
  echo "<br>";
  echo "Judul :".$baris[1]."<br><br>";
  echo "<img src=image/".$baris['Path'].">";
  echo"<br><br><hr>";
 }
?>