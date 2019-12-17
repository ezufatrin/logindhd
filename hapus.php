<?php
include('includes/config.php');


if(isset($_GET['id'])){
    
    $sql="DELETE FROM kolam WHERE id =". $_GET['id'];
    if(mysqli_query($db, $sql)){        
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('Berhasil Menghapus Kolam');
    window.location.href='admin.php';
    </script>");    
    } else { ?>
    <script>alert('Gagal Menghapus?')</script>
    <?php }
} 

if(isset($_GET['user'])){
    $sql="DELETE FROM users WHERE id =". $_GET['user'];
    if(mysqli_query($db, $sql)){ 

   
              
        echo ("<script LANGUAGE='JavaScript'>
    window.alert('User Berhasil dihapus');
    window.location.href='admin.php?user=123';
    </script>");

   
    
    } else { ?>
    <script>alert('Gagal Menghapus?')</script>
    <?php }
} 
    
  