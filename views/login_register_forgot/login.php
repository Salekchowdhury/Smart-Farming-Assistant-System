<?php
/*include_once ("../../includes/head_auth.php");*/
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
use App\Utility\Utility;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Farming</title>
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="../../contents/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/login_page_style.css">
</head>
<body>



<div class="login-wrap" style="border-radius: 10px;">

   <div style="  margin-top: 30px; padding: 20px; border-radius: 10px">
       <?php

       if(isset($_SESSION['errorMessageForLogin'])){

           echo $_SESSION['errorMessageForLogin'];
           unset($_SESSION['errorMessageForLogin']);

       }
       if(isset($_SESSION['paymentApprovalMsg'])){

           echo $_SESSION['paymentApprovalMsg'];
           unset($_SESSION['paymentApprovalMsg']);

       }
       include_once '../google_translation/translation.php';
       ?>
       <h2>LOGIN<span style="color:white"></span></h2>
       <div class="login-form">
           <div class="sign-in-htm">
               <form action="../process/data_process.php" method="post">
                   <div class="group">

                       <input name="email" required placeholder=" Email....." style="width: 80%; height: 45px;  opacity: 1;border-radius: 15px;  border: none;
    outline: none;background-color: white;" type="text" class="">
                   </div>
                   <div class="group">

                       <input name="password" required placeholder=" Password...." type="password" class="" data-type="password"  style="width: 80%; opacity: 1;height: 45px;  border-radius: 15px;  border: none;
    outline: none;background-color: white">
                   </div>
                   <div class="row">
                       <div class="col-6">

                           <div class="group">
                               <input type="submit" name="login" class="button" value="Login">

                               <div class="hr"></div>
                               <a class="btn btn-info my-1" href="../landing_page/index.php"  value="Home">Home</a>
                               <div class="">
                                   <a href="register.php">Register</a>
                               </div>
                               <br>
                               <div class="">
                                   <a href="forgot-password.php">Forgot Password?</a>
                               </div>
                           </div>
                       </div>
                       <div class="col-6" style="margin-top: 120px">
                           <img src="../../contents/img/farmer.png" width="150" height="150" style="border-radius: 50%">
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>

</div>


</body>
</html>