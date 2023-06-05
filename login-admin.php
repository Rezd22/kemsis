<?php
	session_start();
	require "koneksi.php";

	$errors = array();
	
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi, $_POST['admin']);
		$password = mysqli_real_escape_string($koneksi, $_POST['password']);
		$check_user = "SELECT * FROM admin WHERE username = '$username'";
		$res = mysqli_query($koneksi, $check_user);
		if(mysqli_num_rows($res) > 0){
			$fetch = mysqli_fetch_assoc($res);
			$fetch_pass = $fetch['password'];
			if($fetch_pass){
				$_SESSION['admin'] = $username;
				$_SESSION['login'] = true;
				header('location: admin.php');
				exit;
			}else{
				$errors['admin'] = "Incorrect username or password!";
			}
		}else{
			$errors['admin'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
		}
	}
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAVE IN</title>
	<link href="assets/img/logo.png" rel="icon">
  	<link href="assets/img/logo.png" rel="apple-touch-icon">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
	          background: url(img/aa.jpg) no-repeat fixed;
	          -webkit-background-size: 100% 100%;
	          -moz-background-size: 100% 100%;
	          -o-background-size: 100% 100%;
	          background-size: 100% 100%;
	        }
		.row {
			margin:100px auto;
			width:300px;
			text-align:center;
		}
		.login {
			background-color:#FFFFFF;
			padding:20px;
			margin-top:20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="center">
				<div class="login">	
					<form role="form" action="" method="post">
					<h3> Sistem Inventaris Barang</h3><br>
					<?php
               		if(count($errors) > 0){
                  		?>
                  		<div class="alert alert-danger text-center">
                    		<?php
                     		foreach($errors as $showerror){
                        		echo $showerror;
                     		}
                    		?>
                  		</div>
                  		<?php
               		}
               		?>	
						<div class="form-group">
							<input type="text" name="admin"  class="form-control" placeholder="Username" required autofocus />
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-primary btn-block" value="LOGIN" />	
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>