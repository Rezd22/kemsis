<?php
require "koneksi.php";
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$check = "DELETE FROM users WHERE id = '$id'";
$result = mysqli_query($koneksi, $check);
if($result){
?>
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=pengguna";
	</script>
	
 <?php
}
?>