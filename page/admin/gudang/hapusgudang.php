<?php
require "koneksi.php";
$kode_barang = mysqli_real_escape_string($koneksi, $_GET['kode_barang']);
$check = "DELETE FROM gudang WHERE kode_barang = '$kode_barang'";
$result = mysqli_query($koneksi, $check);
if($result){
?>
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=gudang";
	</script>
	
 <?php
}


?>
