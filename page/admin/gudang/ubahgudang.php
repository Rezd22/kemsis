

<?php
require "koneksi.php";
 $kode_barang = $_GET['kode_barang'];
 $sql2 = $koneksi->query("select * from gudang where kode_barang = '$kode_barang'");
 $tampil = $sql2->fetch_assoc();
 
 $level = $tampil['level'];

 
 
 
 ?>
 
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah User</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">

							<form method="POST" enctype="multipart/form-data">
							
							<label for="">Kode Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                  <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $tampil['kode_barang']; ?>" readonly />	 
							</div>
                            </div>
							
								
							<label for="">Nama Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama_barang" value="<?php echo $tampil['nama_barang']; ?>" class="form-control" /> 	 
							</div>
                            </div>
				
							
							
							<label for="">Jenis Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="jenis_barang" class="form-control" />	 
							</div>
                            </div>
							
							
                          
                                     
			
							<label for="">Satuan Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="satuan_barang" class="form-control" />	 
							</div>
                            </div>
							
						
							
						
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
							<?php
							
								if (isset($_POST['simpan'])) {
		
								$kode_barang= $_POST['kode_barang'];
								$nama_barang= $_POST['nama_barang'];
								$jenis_barang= $_POST['jenis_barang'];
								$satuan= $_POST['satuan_barang'];
								

								$sql = $koneksi->query("update gudang set kode_barang='$kode_barang', nama_barang='$nama_barang', jenis_barang='$jenis_barang', satuan='$satuan' where kode_barang='$kode_barang'"); 
								
								if ($sql2) {
									?>
									
										<script type="text/javascript">
										alert("Data Berhasil Diubah");
										window.location.href="?page=gudang";
										</script>
										
										<?php
								}
							}
							?>
										
										
										
										
								
								
								
								
								
