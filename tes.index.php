<form name="form1" method="post" action="">
  <label>
    <input type="submit" name="download" id="download" value="Submit">
  </label>
</form>
  <?php if (isset ($_POST["download"])){
if ( $row_Recordset1['tahap_akreditasi']=1);
{
	echo "<script> window.location.href='http://banpaudpnf.or.id/upload/download-center/SK%20Hasil%20Pelatihan%20Tahun%202014%20Tahap%20I_1508472410.pdf';</script>";
}
else
{
	echo "<script> window.location.href='http://banpaudpnf.or.id/upload/download-center/SK%20Hasil%20Pelatihan%20Tahun%202014%20Tahap%20II_1508472460.pdf';</script>";
}
	 }
?>
