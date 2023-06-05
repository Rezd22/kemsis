  
   <script>
 function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahkeluar = document.getElementById('jumlahkeluar').value;
	 var result = parseInt(stok) - parseInt(jumlahkeluar);
	 if (!isNaN(result)) {
		 document.getElementById('total').value = result;
	 }
 }
 </script>
  
  <?php 
  
  
require "koneksi.php";
$user = $_COOKIE['user'];
$no = mysqli_query($koneksi, "select id_transaksi from barang_keluar order by id_transaksi desc");
$idtran = mysqli_fetch_array($no);
$kode = $idtran['id_transaksi'];


$urut = substr($kode, 8, 3);
$tambah = (int) $urut + 1;
$bulan = date("m");
$tahun = date("y");

if(strlen($tambah) == 1){
	$format = "TRK-".$bulan.$tahun."00".$tambah;
} else if(strlen($tambah) == 2){
	$format = "TRK-".$bulan.$tahun."0".$tambah;
	
} else{
	$format = "TRK-".$bulan.$tahun.$tambah;

}

  

$tanggal_keluar = date("Y-m-d");


?>
  
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
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
							
						
							
							<label for="">Tanggal Keluar</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="date" name="tanggal_keluar" class="form-control" id="tanggal_kelauar" value="<?php echo $tanggal_keluar; ?>" />
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
                                <input type="text" name="jumlahkeluar" id="jumlahkeluar" onkeyup="sum()" class="form-control" />
							
                                     
									 
							</div>
                            </div>
							
							
							
							<div class="tampung1"></div>
							
							<label for="">Pengirim</label>
							<div class="form-group">
							   <div class="form-line">
								<input type="text" name="pengirim" class="form-control" value="<?php echo $user; ?>" readonly/>	 
							</div>
							</div>
							<label for="">Tujuan</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="tujuan" class="form-control" />	 
							</div>
                            </div>

							<label for="">Metode Pembayaran</label>
                            <div class="form-group">
                               <div class="form-line">
								<select name="metode_pembayaran" class="form-control show-tick">
                                        <option value="">-- Pilih Metode --</option>
										 <option value="COD">COD</option>
                                        <option value="ATM">ATM</option>
                                    </select>	 
							</div>
                            </div>
							<!-- <?php
								// if($_POST['metode_pembayaran'] == "ATM"){
								// 	echo "<label for=''>Nama Bank</label>";
								// 	echo "<div class='form-group'>";
								// 	echo "<div class='form-line'>";
								// 		echo "<input type='text' name='nama_bank' class='form-control' />";	 
								// 	echo "</div>";
								// 	echo "</div>";

								// 	echo "<label for=''>No Rekening</label>";
								// 	echo "<div class='form-group'>";
								// 	echo "<div class='form-line'>";
								// 		echo "<input type='text' name='no_rekening' class='form-control' />";	 
								// 	echo "</div>";
								// 	echo "</div>";
								// }
							?> -->
							
							<label for="">Admin Yang Memproses</label>
                            <div class="form-group">
                               <div class="form-line">
                                <select name="Admin" id="" class="form-control" />
								<option value="">-- Pilih Admin  --</option>
								<?php
								
								$sql = $koneksi -> query("select * from admin");
								while ($data=$sql->fetch_assoc()) {
									echo "<option value='$data[username]'>$data[username]</option>";
								}
								?>
								
								</select>
                                     
									 
							</div>
                            </div>
						


							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
								if (isset($_POST['simpan'])) {
									if($_POST['metode_pembayaran'] == "COD"){
										$id_transaksi= $_POST['id_transaksi'];
										$tanggal= $_POST['tanggal_keluar'];

										$barang= $_POST['barang'];
										$pecah_barang = explode(".", $barang);
										$kode_barang = $pecah_barang[0];
										$nama_barang = $pecah_barang[1];
										$jumlah= $_POST['jumlahkeluar'];
										
										$pengirim= $_POST['pengirim'];
										$tujuan= $_POST['tujuan'];
										$metode = $_POST['metode_pembayaran'];
										
										$g = $koneksi->query("select id_admin from admin where username = '$_POST[Admin]'");
										$h = mysqli_fetch_array($g);
										$i = $h['id_admin'];			
										$pembayaran = 1;
																
										
										$sql = $koneksi->query("insert into barang_keluar (id_transaksi, tanggal, kode_barang, nama_barang, jumlah, pengirim, tujuan, id_admin, metode, id_pembayaran) values('$id_transaksi','$tanggal','$kode_barang','$nama_barang','$jumlah','$pengirim','$tujuan', '$i', '$metode','$pembayaran)");
										$sql2 = $koneksi-> query("update gudang set jumlah=(jumlah) where kode_barang='$kode_barang'");
										
										if($sql){

											?>
											<script type="text/javascript">
											alert("Simpan Data Berhasil");
											window.location.href="?page=barangkeluar";
											
											</script>
											<?php

										}
													
									}elseif ($_POST['metode_pembayaran'] == "ATM") {
										$id_transaksi= $_POST['id_transaksi'];
										$tanggal= $_POST['tanggal_keluar'];

										$barang= $_POST['barang'];
										$pecah_barang = explode(".", $barang);
										$kode_barang = $pecah_barang[0];
										$nama_barang = $pecah_barang[1];
										$jumlah= $_POST['jumlahkeluar'];
										
										$pengirim= $_POST['pengirim'];
										$tujuan= $_POST['tujuan'];
										$metode = $_POST['metode_pembayaran'];
										
										$g = $koneksi->query("select id_admin from admin where username = '$_POST[Admin]'");
										$h = mysqli_fetch_array($g);
										$i = $h['id_admin'];

										setcookie('id_transaksi', $id_transaksi);
										setcookie('tanggal_keluar', $tanggal);
										setcookie('barang', $barang);
										setcookie('jumlah_keluar', $jumlah);
										setcookie('pengirim', $pengirim);
										setcookie('metode_pembayaran', $metode);
										setcookie('id_admin', $i);
										header(Location: 'page/user/barangkeluar/pembayaran.php');
									}
								}
							?>