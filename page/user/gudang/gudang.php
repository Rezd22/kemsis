<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Stok Gudang</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
						  <th>No</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>											
							<th>Jenis Barang</th>
              <th>Jumlah Barang</th>
							<th>Satuan</th>
							<th>Pengaturan</th>
            </tr>
					</thead>
					<tbody>
            <?php 
              require "koneksi.php";
              $user = $_COOKIE['user'];
              $no = 1;
              $check= "SELECT * FROM gudang";
              // $check= "SELECT * FROM gudang where username = '$user";
		          $result = mysqli_query($koneksi, $check);
              while ($fetch = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
							<td><?php echo $fetch['kode_barang'] ?></td>
							<td><?php echo $fetch['nama_barang'] ?></td>
							<td><?php echo $fetch['jenis_barang'] ?></td>
              <td><?php echo $fetch['jumlah'] ?></td>
							<td><?php echo $fetch['satuan'] ?></td>
							<td>
							  <a href="?page=gudang&aksi=ubahgudang&kode_barang=<?php echo $fetch['kode_barang'] ?>" class="btn btn-success" >Ubah</a>
							</td>
            </tr>
						<?php }?>
          </tbody>
        </table>
				<a href="?page=gudang&aksi=tambahgudang" class="btn btn-primary" >Tambah Data Barang</a>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>