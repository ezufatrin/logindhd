<?php

session_start();
include('includes/config.php');
if(isset($_SESSION['alogin'])){
	header('location:profile.php');
}
$pesan ="";
if(isset($_POST['reset']))
{
$email = $_POST['username'];
	$kode = uniqid(true); 
	$query = mysqli_query($db, "INSERT INTO reset_password VALUES ('','$email','$kode')");
	$cekEmail = mysqli_query($db, "SELECT email FROM users WHERE email= '".$email."'");
	if(mysqli_num_rows($cekEmail)==0){ echo "<script>alert('Email anda belum terdaftar');</script>";}
	else{
		if(!$query){ exit("Error");}
		require_once 'mail/vendor/autoload.php';
	
		$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'));
		$transport->setUsername("dhdtekno@gmail.com");
		$transport->setPassword("dhdtekno123");	
		$mailer = new Swift_Mailer($transport);
		$url = "http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/reset.php?kode=$kode";
		$message = (new Swift_Message('Reset Password'))
		->setFrom(['dhdfarm@gmail.com' => 'DHD FARM'])
		->setTo(['bucugarang@gmail.com' => 'Reset Password'])
		->setBody("<h2>Permintaan reset password</h2><p> Klik <a href='$url'>link ini</a> untuk mereset password</p>","text/html");
	
		
		if($mailer->send($message)==TRUE){
			$pesan = "BERHASIL: Link Reset Password Sudah dikirim ke email ". $email. " silahkan cek inbox email anda";	
		}
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
			<div class="wrap-login100 p-b-30">
				<form class="login100-form validate-form" method="POST" >
					<div class="login100-form-avatar">
						<a href="index.php"><img src="images/header-dhd.png" alt="AVATAR"></a>
						<!-- <img src="login/images/logo-dhd.png" alt="AVATAR">					 -->
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Masukan Alamat Email
					</span>					

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username harus diisi">
						<input class="input100" type="text" name="username" placeholder="Email" id="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>	

					<div class="wrap-input100 validate-input m-b-10" data-validate="Username harus diisi">
						<p class="txt1 text-white"><?php echo $pesan ?></p>
					</div>			

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn" name="reset">
							RESET
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-100">
						<p  class="txt1 text-white">Kembali ke halaman login? <a  class="txt1 text-warning" href="login.php" >kembali</a></p>
					</div>
				</form>
		
				
			</div>
		</div>
	</div>
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
</script>


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