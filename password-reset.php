<?php
	session_start();
	require "koneksi.php";

	$errors = array();
    
	if(isset($_POST['login-now'])){
        header('Location: login.php');
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
					<h3> Sistem Inventaris Barang</h3><br>
					<?php
                    if(isset($_SESSION['info'])){
                    ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                    <?php
                    }
                    ?>
						<div class="form-group">
							<input type="submit" name="login-now" class="btn btn-primary btn-block" value="LOGIN NOW" />	
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