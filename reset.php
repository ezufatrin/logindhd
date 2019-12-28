<?php
include('includes/config.php');
$flag=0;
if(isset($_POST['reset']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "UPDATE users SET password = '".md5($password)."' WHERE email = '".$email."'";    
    if(mysqli_query($db, $sql)){
        $pesan = "RESET PASSWORD BERHASIL";
        $flag=1;
    } else {$pesan = "RESET PASSWORD GAGAL"; $flag=2;}  
}

if(isset($_GET['kode']))
{
    $kode = $_GET['kode']; 
    $query = mysqli_query($db, "SELECT * FROM reset_password WHERE kode= '".$kode."'");
    if(mysqli_num_rows($query)>0)
    {
        
    $email = mysqli_fetch_assoc($query)['email'];
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
                        <?php if($flag==0) { ?>
    
                        <span class="login100-form-title p-t-20 p-b-45">
                            MASUKAN PASSWORD BARU ANDA
                        </span>			
    
                        <input type="hidden" value="<?php echo $email; ?>" name="email">
                        
                        <div class="wrap-input100 validate-input m-b-10" data-validate="password harus diisi">
                            <input class="input100" type="password" name="password" placeholder="password baru" id="password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>	
                        <div class="wrap-input100 validate-input m-b-10" data-validate="password harus diisi">
                        <span class="focus-input100"><?php echo $pesan; ?></span>
                        </div>	
    
                        <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn" name="reset">
                                RESET
                            </button>
                        </div>
    
                        
                    </form>
                        <?php } else { ?>
                            <div class="text-center w-full p-t-25 p-b-100">
                                <h5>RESET PASSWORD BERHASIL</h5>
                                <h5  class="text-white">Kembali ke halaman login? <a  class="text-warning" href="login.php" ><h5>login</h5></a></h5>
                            </div>
                            <?php } ?>
    
                            
                    
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
    
    <?php
    } else {header('location:login.php');} 
    
}else {header('location:login.php');}