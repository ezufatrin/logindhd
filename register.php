<?php
include('includes/config.php');
$statusSukses =0;
if(isset($_POST['submit']))
{  

    // $name=$_POST['name'];
    // $email=$_POST['email'];
    // $password=md5($_POST['password']);
    // $gender=$_POST['gender'];
    // $mobileno=$_POST['mobile'];
    // $designation=$_POST['designation'];
    
    // $sqlnoti="insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    // $querynoti = $dbh->prepare($sqlnoti);
    // $querynoti-> bindParam(':notiuser', $sender, PDO::PARAM_STR);
    // $querynoti-> bindParam(':notireciver',$reciver, PDO::PARAM_STR);
    // $querynoti-> bindParam(':notitype', $notitype, PDO::PARAM_STR);
    // $querynoti->execute();    
        
    // $sql ="INSERT INTO users(name,email, password, gender, mobile, designation) VALUES(:name, :email, :password, :gender, :mobileno, :designation )";
    // $query= $dbh -> prepare($sql);
    // $query-> bindParam(':name', $name, PDO::PARAM_STR);
    // $query-> bindParam(':email', $email, PDO::PARAM_STR);
    // $query-> bindParam(':password', $password, PDO::PARAM_STR);
    // $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
    // $query-> bindParam(':mobile', $mobileno, PDO::PARAM_STR);
    // $query-> bindParam(':designation', $designation, PDO::PARAM_STR);  
    // $query->execute();
    // $lastInsertId = $dbh->lastInsertId();
    // if($lastInsertId)
    // {
    //     echo "<script type='text/javascript'>alert('Registration Sucessfull!');</script>";
    //     echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    // }
    // else 
    // {
    //     $error="Something went wrong. Please try again";
    // }

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $gender=$_POST['gender'];
    $nohp=$_POST['mobile'];
    $designation=$_POST['designation'];
    $sql = "SELECT * FROM users WHERE email = '".$email."'";
    $cekUser = mysqli_query($db, $sql);
    if(mysqli_fetch_assoc($cekUser))
    {
        echo '<script>alert("data user sudah ada, gunakan nama yang lain atau login sekarang");</script>';
        // header("Location:login.php");
    }
    else
    {        
        $status=1;
        $sql = "INSERT INTO users (name, email, password, gender, designation, mobile, status)
        VALUES ('".$name."','".$email."', '".$password."' ,'".$gender."','".$designation."','".$nohp."','".$status."')";  
        if (mysqli_query($db, $sql)) 
        { 
            $statusSukses=1;    
        } 
        else 
        {
            echo mysqli_error($db);            
        }
    }   
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
  

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
    <script type="text/javascript">
	function validate()
        {
            var extensions = new Array("jpg","jpeg");
            var image_file = document.regform.image.value;
            var image_length = document.regform.image.value.length;
            var pos = image_file.lastIndexOf('.') + 1;
            var ext = image_file.substring(pos, image_length);
            var final_ext = ext.toLowerCase();
            for (i = 0; i < extensions.length; i++)
            {
                if(extensions[i] == final_ext)
                {
                    return true;
                }
            }
            alert("Image Extension Not Valid (Use Jpg,jpeg)");
            return false;        
            }
        
</script>

<style>
        ::-webkit-input-placeholder { /* Edge */
        color: red;
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: red;
        }

        ::placeholder {
        color: red;
        }
</style>
</head>

<body>
<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-login.jpg');">
			<div class="wrap-login100 p-t-100 p-b-30">
                                <form class="form-horizontal" method="post" action="register.php">
                                    <div class="login100-form-avatar">
                                        <a href="index.php"><img src="images/header-dhd.png" alt="AVATAR"></a>
                                        <!-- <img src="login/images/logo-dhd.png" alt="AVATAR">					 -->
                                    </div>

                                    <span class="login100-form-title p-t-20 p-b-45">
                                        FORM REGISTRASI
                                        <br>
                                        DHD Farm Indonesia
                                    </span>		
                                    <?php if($statusSukses==1){
                                    ?>
                                   <h5 class="bg-warning text-dark mb-4 pl-2">Registrasi akun anda berhasil, <a class="text-info font-weight-bold" href="login.php" > MASUK</a></h5>
                                    <?php } ?> 
                                    

                                    <div class="wrap-input100 validate-input m-b-10" data-validate="Nama harus diisi">
                                        <input class="input100" type="text" name="name" placeholder="Nama Lengkap" id="username" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input m-b-10" data-validate="Email harus diisi">
                                        <input class="input100" type="text" name="email" placeholder="Email" id="username" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>


                                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password harus diisi">
                                        <input class="input100" type="password" name="password" placeholder="Password" id="username" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input m-b-10" data-validate="Nama Panggilan harus diisi">
                                        <input class="input100" type="text" name="designation" placeholder="Nama Panggilan" id="username" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input m-b-10" data-validate="No Hp harus diisi">
                                        <input class="input100" type="text" name="mobile" placeholder="No Hanphone" id="username" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input m-b-10" data-validate="Jenis Kelamin harus diisi">
                                        <select name="gender" class="input100 "  required>                                                    
                                            <option selected="selected" style="display:none; color:red" >Pilih jenis kelamin</option>
                                            <option value="Male">Laki-laki</option>
                                            <option value="Female">Wanita</option>
                                        </select>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-venus-mars"></i>
                                        </span>
                                    </div>




<!-- 

                                    <div class="form-group">
                                        <label  class="cols-sm-2 control-label">Nama</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa mr-2" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="nama lengkap" required />
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="cols-sm-2 control-label">Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope fa mr-2" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="email" required/>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label class="cols-sm-2 control-label">Password</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock fa-lg mr-2" aria-hidden="true"></i></span>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="masukan password" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="cols-sm-2 control-label">Nama Panggilan</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user fa mr-2" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="designation" placeholder="nama panggilan"required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="cols-sm-2 control-label">No Hp</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-phone fa mr-2" aria-hidden="true"></i></span>
                                                <input type="text" class="form-control" name="mobile" placeholder="nomor handphone"required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="cols-sm-2 control-label">Jenis Kelamin</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fas fa-venus-mars fa mr-2" aria-hidden="true"></i></span>
                                                <select name="gender" class="form-control " required>                                                    
                                                    <option selected="selected" style="display:none">Pilih jenis kelamin</option>
                                                    <option value="Male">Laki-laki</option>
                                                    <option value="Female">Wanita</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    <!-- <div class="form-group">
                                        <label class="cols-sm-2 control-label">Foto Diri</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users fa mr-2" aria-hidden="true"></i></span>
                                                <input type="file" class="form-control" name="image" placeholder="Upload foto diri"/>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="container-login100-form-btn p-t-10">
                                        <button class="login100-form-btn" name="submit">
                                            Daftar
                                        </button>
                                    </div>

                                    <!-- <div class="form-group ">
                                        <button type="submit"  name="submit" class="btn btn-primary btn-lg btn-block login-button">Daftar</button>
                                    </div> -->


                                    <!-- <div class="login-register">
                                        <p>Sudah punya akun? <a class="text-info" href="login.php" >Masuk</a></p>
                                    </div> -->
                                    
                                </form>

                                <form action="login.php">
                                    <div class="container-login100-form-btn p-t-10">
                                            <button class="login100-form-btn" >
                                                <p class="text-white">Sudah punya akun? <a class="text-info" href="login.php" >Masuk</a></p>
                                            </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
</div>
</div>
</div>
</div>

	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

    <script>
                $(document).ready(function() {
            $('#select').css('color','gray');
            $('#select').change(function() {
                var current = $('#select').val();
                if (current != 'null') {
                    $('#select').css('color','black');
                } else {
                    $('#select').css('color','gray');
                }
            }); 
            });
    </script>

</body>
</html>