<?php
	session_start();
	require "koneksi.php";

	$errors = array();
    $_SESSION['info'] = "Please enter your username and create a new password";
	
	if(isset($_POST['continue'])){
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);
        $cpassword = mysqli_real_escape_string($koneksi, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
        $user_check = "SELECT * FROM users WHERE username='$username'";
        $run_sql = mysqli_query($koneksi, $user_check);
        if(mysqli_num_rows($run_sql) === 0){
            $errors['username'] = "This username address does not exist!";
        }
        if(count($errors) === 0){
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET password = '$encpass' WHERE username = '$username'";
            $run_sql = mysqli_query($koneksi, $update_pass);
            if($run_sql){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('location: password-reset.php');
                exit();
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
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
	          background: url(img/grey.jpg) no-repeat fixed;
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
					<h3> Reset Password</h3><br>
					<?php
               		if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                        }
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo "$error <br>";
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>	
						<div class="form-group">
							<input type="text" name="username"  class="form-control" placeholder="Username" required autofocus />
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
						</div>
						<div class="form-group">
							<input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required autofocus />
						</div>
						<div class="form-group">
							<input type="submit" name="continue" class="btn btn-primary btn-block" value="CONTINUE" />	
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