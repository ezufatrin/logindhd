<?php

session_start();
include('includes/config.php');
if(isset($_SESSION['alogin'])){
	header('location:profile.php');
}

if(isset($_POST['login']))
{
	// $status='1';
	// $role = '1';
	$email=$_POST['username'];
	$password=md5($_POST['password']);
	
		$sql ="SELECT email,password,status FROM users WHERE email=:email and password=:password";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':email', $email, PDO::PARAM_STR);
		$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		// var_dump($results);
		// var_dump(get_object_vars($results[0])); die();	
		$status = get_object_vars($results[0])['status'];

		$_SESSION['alogin']=$_POST['username'];		
		if($status == 1){					
			echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
		} else if($status == 2){
			$_SESSION ['awal'] = 1;	
			echo "<script type='text/javascript'> document.location = 'admin.php'; </script>";
		}
		
		
	} else{ 
		echo "<script>alert('Username atau Passwordnya Salah');</script>";
	}

}
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
				<form class="login100-form validate-form" method="POST" >
					<div class="login100-form-avatar">
						<a href="index.php"><img src="images/header-dhd.png" alt="AVATAR"></a>
						<!-- <img src="login/images/logo-dhd.png" alt="AVATAR">					 -->
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						DHD Farm Indonesia
					</span>					

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username harus diisi">
						<input class="input100" type="text" name="username" placeholder="Username/Email" id="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Password harus diisi">
						<input class="input100" type="password" name="password" placeholder="Password" id="password">
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

					<!-- <div class="text-center w-full p-t-25 p-b-100">
						<p  class="txt1 text-white">Don't Have an Account? <a  class="txt1 text-dark" href="register.php" >Signup</a></p>
					</div> -->
				</form>
				<form action="register.php">
					<div class="container-login100-form-btn p-t-10">
							<button class="login100-form-btn" >
								Daftar
							</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
s
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