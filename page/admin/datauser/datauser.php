<?php
function shiftEncrypt($text, $shift)
{
  $result = "";

  $length = strlen($text);
  for ($i = 0; $i < $length; $i++) {
    $char = $text[$i];
    if (ctype_alpha($char)) {
      $ascii = ord(ctype_upper($char) ? 'A' : 'a');
      $encryptedAscii = ($ascii + $shift - ($ascii > 90 ? 97 : 65)) % 26 + ($ascii > 90 ? 97 : 65);
      $result .= chr($encryptedAscii);
    } else {
      $ascii = ord($char);
      $encryptedAscii = ($ascii + $shift) % 256;
      $result .= chr($encryptedAscii);
    }
  }

  return $result;
} ?>


<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
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
            $check = "SELECT * FROM users";
            $result = mysqli_query($koneksi, $check);
            while ($fetch = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?php echo $fetch['id'] ?></td>
                <td><?php echo $fetch['username'] ?></td>
                <td><?php echo $fetch['fullname'] ?></td>
                <td><?php echo $fetch['email'] ?></td>

                <td><?php echo md5(shiftEncrypt($fetch['password'], 23)) ?></td>
                <td>
                  <a href="?page=pengguna&aksi=ubahpengguna&id=<?php echo $fetch['id'] ?>" class="btn btn-success">Ubah</a>
                  <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=pengguna&aksi=hapuspengguna&id=<?php echo $fetch['id'] ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <a href="?page=pengguna&aksi=tambahpengguna" class="btn btn-primary">Tambah</a>
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>