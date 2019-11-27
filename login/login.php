<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>DHD Farm Indonesia</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="login/images/icons/favicon-dhd.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<!--===============================================================================================-->
</head>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-login.jpg');">
			<div class="wrap-login100 p-t-100 p-b-30">
				<form class="login100-form validate-form" method="POST" action="dashboard.php">
					<div class="login100-form-avatar">
						<img src="login/images/logo-dhd.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						DHD Farm Indonesia
					</span>					

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username harus diisi">
						<input class="input100" type="text" name="username" placeholder="Username" id="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Password harus diisi">
						<input class="input100" type="password" name="pass" placeholder="Password" id="password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-100">
						<a href="#" class="txt1">
							Forgot Username / Password?
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
<!-- 
<script type="text/javascript">
	function validasi() {
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;		
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Username dan Password harus di isi !');
			return false;
		}
	}
</script> -->


	<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>

</html>