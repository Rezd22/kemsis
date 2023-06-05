<div class="container-fluid">
<!-- DataTales Example -->
	<div class="card shadow mb-4">
    	<div class="card-header py-3">
        	<h6 class="m-0 font-weight-bold text-primary">Tambah Pengguna</h6>
        </div>
        <div class="card-body">
        	<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Username</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="username" class="form-control" />	 
							</div>
						</div>
						<label for="">Fullname</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="fullname" class="form-control" />	 
							</div>
						</div>
						<label for="">Email</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="email" class="form-control" />
							</div>
						</div>
						<label for="">Password</label>
						<div class="form-group">
							<div class="form-line">
								<input type="password" name="password" class="form-control" />
							</div>
						</div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>
					<?php
						require "koneksi.php";
						if(isset($_POST["simpan"])){
							$username = mysqli_real_escape_string($koneksi, $_POST['username']);
							$fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
							$email = mysqli_real_escape_string($koneksi, $_POST['email']);
							$password = mysqli_real_escape_string($koneksi, $_POST['password']);
							$user_check = "SELECT * FROM users WHERE username = '$username'";
							$res = mysqli_query($koneksi, $user_check);
							$insert_data = "INSERT INTO users (username, fullname, email, password) values('$username', '$fullname', '$email', '$password')";
							$data_check = mysqli_query($koneksi, $insert_data);
							if($data_check){
							?>
								<script type="text/javascript">
									alert("Data Berhasil Disimpan");
									window.location.href="?page=pengguna";
								</script>
							<?php
							}
						}
					?>