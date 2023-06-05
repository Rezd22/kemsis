<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
						  <th>ID</th>
							<th>Username</th>
							<th>Nama</th>
							<th>Email</th>
              <th>Password</th>
              <th>Aksi</th>
            </tr>
					</thead>
          <tbody>
            <?php 
              require "koneksi.php";
              $check= "SELECT * FROM admin";
		          $result = mysqli_query($koneksi, $check);
              while ($fetch = mysqli_fetch_assoc($result)){
            ?>
            <tr>
              <td><?php echo $fetch['id'] ?></td>
              <td><?php echo $fetch['username'] ?></td>
							<td><?php echo $fetch['fullname'] ?></td>
              <td><?php echo $fetch['email'] ?></td>
              <td><?php echo $fetch['password'] ?></td>
              <td>
							  <a href="?page=admin&aksi=ubahadmin&id=<?php echo $fetch['id'] ?>" class="btn btn-success" >Ubah</a>
								<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=admin&aksi=hapusadmin&id=<?php echo $fetch['id'] ?>" class="btn btn-danger" >Hapus</a>
							</td>
            </tr>
						<?php }?>
          </tbody>
        </table>
				<a href="?page=admin&aksi=tambahadmin" class="btn btn-primary" >Tambah</a>
        </tbody>
        </table>
              </div>
            </div>
          </div>

        </div>












