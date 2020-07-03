<form name="visi" method="post" action="posting.foto.php" enctype="multipart/form-data">
Judul <input type="text" name="judul">
Gambar<br>
<img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
<input id="uploadImage" type="file" name="image" onchange="PreviewImage();" />
<br><br>
<input type="submit" width="120" height="24" name="simpan" value="Submit" >
</form>