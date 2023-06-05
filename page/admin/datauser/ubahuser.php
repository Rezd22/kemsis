<?php
require "koneksi.php";
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$check = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($koneksi, $check);
$fetch = mysqli_fetch_assoc($result);
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
						<label for="">Username</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" name="username" value="<?php echo $fetch['username']; ?>" class="form-control" readonly/>
								   </div>
							</div>
						<label for="">Fullname</label>
                    	<div class="form-group">
                        	<div class="form-line">
                            	<input type="text" name="fullname" value="<?php echo $fetch['fullname']; ?>" class="form-control" />
							</div>
                        </div>
						<label for="">Email</label>
                        	<div class="form-group">
                            	<div class="form-line">
                                	<input type="text" name="email" value="<?php echo $fetch['email']; ?>" class="form-control" />
								</div>
	                        </div>
						<label for="">Password</label>
                            <div class="form-group">
                            	<div class="form-line">
                                	<input type="password" name="password" value="<?php echo $fetch['password']; ?>" class="form-control" />
                          	 	</div>
                            </div>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</form>
					<?php
						if(isset($_POST["simpan"])){
							$username = mysqli_real_escape_string($koneksi, $_POST['username']);
							$fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
							$email = mysqli_real_escape_string($koneksi, $_POST['email']);
							$password = mysqli_real_escape_string($koneksi, $_POST['password']);
							$update_data = "UPDATE users SET username='$username', fullname='$fullname', email='$email', password='$password' WHERE id = $id";
							$data_check = mysqli_query($koneksi, $update_data);
							if($data_check){
							?>
								<script type="text/javascript">
									alert("Data Berhasil Diubah");
									window.location.href="?page=pengguna";
								</script>
							<?php
							}
						}
					?>
										
										
										
								
								
								
								
								
