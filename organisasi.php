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
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="955" height="425" border="0">
  <tr>
    <td width="130" align="left" valign="top"><ul id="MenuBar1" class="MenuBarVertical">
      <li><a href="?mn=organisasi&amp;aksi=dasarhukum">Dasar Hukum</a></li>
      <li><a href="?mn=organisasi&amp;aksi=visimisi">Visi Misi</a></li>
      <li><a href="?mn=organisasi&amp;aksi=profillembaga">Profil Lembaga</a></li>
      <li><a href="?mn=organisasi&amp;aksi=struktur">Struktur Organisasi</a></li>
      <li><a href="?mn=organisasi&amp;aksi=anggota">Anggota BAP PAUD dan PNF Bengkulu</a></li>
    </ul></td>
    <td width="815" align="center" valign="top" bgcolor="#FFFFFF">
    
      <?php @$mn=$_GET['mn']; @$aksi=$_GET['aksi']; ?>
        <?php if (empty($mn)) include('dasar.hukum.php');?>
		
	   <?php if ($mn=='organisasi') { 
		  if ($aksi=='dasarhukum') include("dasar.hukum.php");
		  if ($aksi=='visimisi') include("visi.misi.php");	
		  if ($aksi=='profillembaga') include("profil.lembaga.php");
		  if ($aksi=='struktur') include("struktur.php");
		  if ($aksi=='anggota') include("profil.anggota.php");
	}?>
		
		
		
		
		
    
    
    </td>
  </tr>
</table>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>