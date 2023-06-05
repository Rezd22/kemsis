  
   <script>
 function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahmasuk = document.getElementById('jumlahmasuk').value;
	 var result = parseInt(stok) + parseInt(jumlahmasuk);
	 if (!isNaN(result)) {
		 document.getElementById('jumlah').value = result;
	 }
 }
 </script>
  
<?php 

require "koneksi.php";
$no = mysqli_query($koneksi, "select id_transaksi from barang_masuk order by id_transaksi desc");
$idtran = mysqli_fetch_array($no);
$a = mysqli_query($koneksi, "select id_barang_masuk from barang_masuk order by id_barang_masuk desc");
$b = mysqli_fetch_array($a);
$kode = $idtran['id_transaksi'];

$id_barang_masuk = $b['id_barang_masuk']+1;
$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");
$user = $_COOKIE['user'];
$g = $koneksi->query("select id_user from users where username = '$user'");
$h = mysqli_fetch_array($g);
$i = $h['id_user'];

if(strlen($tambah) == 1){
	$format = "TRM-".$bulan.$tahun."00".$tambah;
} else if(strlen($tambah) == 2){
	$format = "TRM-".$bulan.$tahun."0".$tambah;
	
} else{
	$format = "TRM-".$bulan.$tahun.$tambah;

}

  
  
$tanggal_masuk = date("Y-m-d");


?>
  
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">
							
							<form method="POST" enctype="multipart/form-data">
							
							<label for="">Id Transaksi</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly /> 
							</div>
                            </div>
							

							<label for="">Id Barang Masuk</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="text" name="id_barang_masuk" class="form-control" id="id_barang_masuk" value="<?php echo $id_barang_masuk; ?>" readonly />
							</div>
                            </div>
						
							
							<label for="">Tanggal Masuk</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" />
							</div>
                            </div>
							
					
							<label for="">Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <select name="barang" id="cmb_barang" class="form-control" />
								<option value="">-- Pilih Barang  --</option>
								<?php
								
								$sql = $koneksi -> query("select * from gudang order by kode_barang");
								while ($data=$sql->fetch_assoc()) {
									echo "<option value='$data[kode_barang].$data[nama_barang]'>$data[kode_barang] | $data[nama_barang]</option>";
								}
								?>
								
								</select>
                                     
									 
							</div>
                            </div>

							
							<div class="tampung"></div>
					
							<label for="">Jumlah</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="jumlahmasuk" id="jumlahmasuk" onkeyup="sum()" class="form-control" />
                                     
									 
							</div>
                            </div>
							
											
						
							
							<label for="">Pengirim</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="text" name="pengirim" class="form-control" id="pengirim" value="<?php echo $_COOKIE['user']; ?>" readonly /> 
							</div>
                            </div>
							<label for="satuan">Satuan</label>
                            <div class="form-group">
                               <div class="form-line">
                               <input name="satuan" id="satuan" type="text" class="form-control">
                                     
									 
							</div>
                            </div>
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								$id_barang_masuk= $_POST['id_barang_masuk'];
								$id_transaksi= $_POST['id_transaksi'];
								$tanggal= $_POST['tanggal_masuk'];

								$barang= $_POST['barang'];
								$pecah_barang = explode(".", $barang);
								$kode_barang = $pecah_barang[0];
								$nama_barang = $pecah_barang[1];
								
								
								$metode_pembayaran= $_POST['metode_pembayaran'];
								$status_pembayaran= $_POST['status_pembayaran'];
								$jumlah= $_POST['jumlahmasuk'];

								
								$pengirim= $_POST['pengirim'];
								$satuan = $_POST['satuan'];
								
								
							
								
								$sql = $koneksi->query("insert into barang_masuk (id_transaksi, id_barang_masuk, tanggal, kode_barang, nama_barang, jumlah, satuan, pengirim, metode_pembayaran, status_pembayaran, id_user) values('$id_transaksi','$id_barang_masuk','$tanggal','$kode_barang','$nama_barang','$jumlah','$satuan','$pengirim','$metode_pembayaran', '$status_pembayaran', '$i')");
								
								


									
									if ($sql) {
									?>
									<script type="text/javascript">
										alert("Simpan Data Berhasil");
										window.location.href="?page=barangmasuk";
										
										</script>
										<?php
								}
							}
							
							
							?>
										
								
										
										
								
										
								
								
								
							
									
							
								
								
								
								
								
