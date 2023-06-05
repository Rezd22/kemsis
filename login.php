<?php
session_start();
require "koneksi.php";

$errors = array();

if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = mysqli_real_escape_string($koneksi, $_POST['password']);
	$check_user = "SELECT * FROM users WHERE username = '$username'";
	$res = mysqli_query($koneksi, $check_user);
	if (mysqli_num_rows($res) > 0) {
		$fetch = mysqli_fetch_assoc($res);
		$fetch_pass = $fetch['password'];
		if ($fetch_pass) {
			$_SESSION['username'] = $username;
			setcookie('user', $username);
			$_SESSION['login'] = true;
			header('location: index2.php');
			exit;
		} else {
			$errors['username'] = "Incorrect username or password!";
		}
	} else {
		$errors['username'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
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
			margin: 100px auto;
			width: 300px;
			text-align: center;
		}

		.login {
			background-color: #FFFFFF;
			padding: 20px;
			margin-top: 20px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="center">
				<div class="login">
					<form role="form" action="" method="post">
						<h3> LOGIN</h3><br>
						<?php
						if (isset($_SESSION['info'])) {
						?>
							<div class="alert alert-success text-center">
								<?php echo $_SESSION['info']; ?>
							</div>
						<?php
						}
						if (count($errors) > 0) {
						?>
							<div class="alert alert-danger text-center">
								<?php
								foreach ($errors as $showerror) {
									echo $showerror;
								}
								?>
							</div>
						<?php
						}
						?>
						<div class="form-group">
							<input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
						</div>
						<div class="form-group">
							<input id="outputText" type="password" name="password" class="form-control" placeholder="Password" style=" display: none;" required autofocus />
						</div>

						<!-- <div class="form-group">
							<a href="forget-password.php">Forgot Password?</a>
						</div> -->
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-primary btn-block" value="LOGIN" />
						</div>
						<div class="form-group">
							Don't have account?
							<a href="signup.php">Signup Now</a>
						</div>
					</form>
					<main>

						<section>
							<div class="flex-left">
							</div>
							<div class="flex-row">
								<div style="width: 50%; padding: 0px 50px 0px 20px;">
									<div id="imageDrop"></div>
								</div>
								<div>
									Select an image from your computer
									<input type="file" accept="image/*" onchange="ParseImageFromFileInput(this);" />
								</div>
							</div>
							<hr>
							<div class="flex-row" style="justify-content: center;">
								<!-- <strong style="margin-right: 10px;">
			<p>Input Image</p>
		</strong> -->
								<img id="inputImage" src="" style="width: 250px" />
							</div>
						</section>

						<section>
							<div class="flex-row" style="justify-content: space-evenly; align-items: start;">
								<div>
									<div class="flex-left">
									</div>
									<!-- <textarea id="inputText" placeholder="Text to encode"></textarea> -->
									<button id="encodeButton" style=" display: none;" onclick="" disabled></button>
								</div>

								<div class="form-group">

									<br>

									<button id="decodeButton" onclick="" class="form-control" disabled>Input Password</button>
								</div>
							</div>
						</section>
					</main>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		// ===== Image Parsing Functions ===== //
		// Reads an image from the drag and drop image selector
		function ParseImageFromDrop(event) {
			event.stopPropagation();
			event.preventDefault();
			if (event.dataTransfer.files && event.dataTransfer.files[0]) {
				LoadImage(event.dataTransfer.files[0]);
			}
		}

		// Reads an image from an HTML input element
		function ParseImageFromFileInput(input) {
			if (input.files && input.files[0]) {
				LoadImage(input.files[0]);
			}
		}

		// Loads an image from the given URL, so that it can be decoded or encoded
		function LoadImage(imageData) {
			let fileReader = new FileReader();
			fileReader.onload = function(e) {
				ImageLoaded(e.target.result);
			};
			fileReader.readAsDataURL(imageData);
		}

		function ImageLoaded(imageSrc) {
			// Display the loaded image, clear existing output, and enable encoding/decoding
			document.getElementById("inputImage").setAttribute("src", imageSrc);
			document.getElementById("encodeButton").disabled = false;
			document.getElementById("decodeButton").disabled = false;
			document.getElementById("outputImage").setAttribute("src", "");
			document.getElementById("outputText").value = "";
		}


		// ===== Encoding and Decoding ===== //
		// Converts a string to a byte array of base 64 characters
		function StringToByteArray(string) {
			let safeBase64String = btoa(unescape(encodeURIComponent(string)));
			let byteArray = [];
			for (let i = 0; i < safeBase64String.length; i++) {
				byteArray.push(safeBase64String.charCodeAt(i));
			}
			return byteArray;
		}

		// Converts a byte array of base 64 characters to a string
		function ByteArrayToString(byteArray) {
			let string = "";
			for (let i = 0; i < byteArray.length; i++) {
				string += String.fromCharCode(byteArray[i]);
			}
			return decodeURIComponent(escape(atob(string)));
		}

		// Encodes a string into an image
		function Encode(message, image) {
			// Convert the message into an encodeable format
			let messageBytes = StringToByteArray(message);

			// Add two dummy non-base64 characters at the end to define where the message ends
			messageBytes.push(0);
			messageBytes.push(0);

			// Create and canvas to work on and draw the existing image in it
			let canvas = document.createElement("canvas");
			let ctx = canvas.getContext('2d');
			canvas.width = image.naturalWidth;
			canvas.height = image.naturalHeight;
			ctx.drawImage(image, 0, 0);

			// Get all of the pixel data, because alpha values may make some pixel unsuitible for encoding
			let pixelData = ctx.getImageData(0, 0, canvas.width, canvas.height);


			// Only work on pixels with this alpha value or greater (see note below)
			let alphaConvertLimit = 250;

			// Loop through the image pixels and insert the message data into them
			let pixelIndex = 0;
			let pixel;
			let byteIndex = 0;
			let bitIndex = 0;
			while ((pixelIndex * 4) < pixelData.data.length && byteIndex < messageBytes.length) {
				// If the alpha channel of the pixel is above the limit, convert it to the maximum and use it.
				// The reason for this is that the lower the alpha value, the more the RGB data is truncated.
				// For example, if the alpha value is 50, setting red to be 150 might result in it being 170.
				// This is done automatically to decrease file size.
				if (pixelData.data[(pixelIndex * 4) + 3] >= alphaConvertLimit) {
					// Set the alpha channel to 255
					pixelData.data[(pixelIndex * 4) + 3] = 0xff;

					// Set the red, green, and blue channels
					for (let j = 0; j < 3; j++) {
						let old = pixelData.data[(pixelIndex * 4) + j];
						if (messageBytes[byteIndex] & (1 << bitIndex)) {
							pixelData.data[(pixelIndex * 4) + j] |= 0b00000001;
						} else {
							pixelData.data[(pixelIndex * 4) + j] &= 0b11111110;
						}

						bitIndex++;
						if (bitIndex == 8) {
							byteIndex++;
							bitIndex = 0;
						}
					}
				}

				pixelIndex++;
			}

			// Put the modified data back into the image
			ctx.putImageData(pixelData, 0, 0);

			return {
				dataURL: canvas.toDataURL(),
				messageTruncated: (byteIndex < messageBytes.length)
			};

		}

		// Decodes a string hidden in an image (if there is one)
		function Decode(image) {
			// Create and canvas to work on and draw the existing image in it
			let canvas = document.createElement("canvas");
			let ctx = canvas.getContext('2d');
			canvas.width = image.naturalWidth;
			canvas.height = image.naturalHeight;
			ctx.drawImage(image, 0, 0);

			// Get the pixel data for the relevant parts of the image
			let pixelData = ctx.getImageData(0, 0, canvas.width, canvas.height);

			// Any non-base 64 charcters found are not part of the message
			let base64Characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

			// Only decode pixels at or above this alpha value (see note in Encode() function)
			let alphaConvertLimit = 250;

			// Loop through the message bytes and insert the into the image
			let byteIndex = 0;
			let bitIndex = 0;
			let currentCharacter = 0;
			let decodedCharacters = [];
			for (let i = 0; i < pixelData.data.length; i += 4) {
				// If any non-base 64 characters are encountered, the message is complete
				if (decodedCharacters.length > 0 &&
					base64Characters.indexOf(String.fromCharCode(decodedCharacters[decodedCharacters.length - 1])) === -1) {

					decodedCharacters = decodedCharacters.slice(0, decodedCharacters.length - 1);
					break;
				}

				// As with encoding, only read pixels with sufficient alpha value
				if (pixelData.data[i + 3] >= alphaConvertLimit) {
					// Read the red, green, and blue channels
					for (let j = 0; j < 3; j++) {
						if (pixelData.data[i + j] & 1) {
							currentCharacter |= (1 << bitIndex);
						}

						bitIndex++;
						if (bitIndex == 8) {
							byteIndex++;
							bitIndex = 0;

							decodedCharacters.push(currentCharacter);
							currentCharacter = 0;
						}
					}
				}
			}

			return ByteArrayToString(decodedCharacters);
		}


		// ===== Setup User Interaction =====//
		// Enable drag+drop as well as encode and decode buttons
		function Setup() {
			let imageDropElement = document.getElementById("imageDrop");

			// Change the image drop style when being dragged over
			imageDropElement.ondragover = (event) => {
				event.stopPropagation();
				event.preventDefault();
				document.getElementById("imageDrop").classList.add("active");
			}
			imageDropElement.ondragleave = (event) => {
				event.stopPropagation();
				event.preventDefault();
				document.getElementById("imageDrop").classList.remove("active");
			}

			// When an image is dropped, load it
			imageDropElement.ondrop = (event) => {
				document.getElementById("imageDrop").classList.remove("active");
				ParseImageFromDrop(event);
			}

			// Setup encode and decode buttons
			document.getElementById("encodeButton").onclick = () => {
				let result = Encode(document.getElementById("inputText").value, document.getElementById("inputImage"));
				document.getElementById("outputImage").setAttribute("src", result.dataURL);
				document.getElementById("downloadLink").href = result.dataURL;
				document.getElementById("downloadButton").disabled = false;

				if (result.messageTruncated) {
					alert("Message was too large for the image provided and has been truncated");
				}
			}
			document.getElementById("decodeButton").onclick = () => {
				let result = Decode(document.getElementById("inputImage"));
				document.getElementById("outputText").value = result ? result : "No message found in this image :(";
			}
		}

		window.onload = Setup;
	</script>
</body>

</html>