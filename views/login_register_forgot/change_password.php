<?php
/*include_once ("../../includes/head_auth.php");*/
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
use App\Utility\Utility;
use App\user_registration\registration;
$registration =new registration();
$email=$_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>

    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/custom-style.css">
    <link rel="stylesheet" href="../../contents/css/slick.css">
    <link rel="stylesheet" href="../../contents/css/slick-theme.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../contents/plugins/bootstrap/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<body>

<!--<div class="row" style="background-color: #343a40;">

    <marquee width="100%" direction="left" height="100%">
        <h1 style="color: #4fbd4f">Welcome To Online Tutor and Student Portal System</h1>
    </marquee>
</div>-->
<div class="row">


    <div class="col-sm-8" style="margin-left: 500px;padding-top: 45px">

        <div class="login-box">
            <div class="login-logo">
                <!-- <a href="#"><b>Student</b>Care</a>-->
            </div>
            <div class="card" style="border-bottom-left-radius: 45px;
    border-top-right-radius: 45px;">
                <div class="card-body login-card-body" style="border-bottom-left-radius: 45px;
    border-top-right-radius: 45px; border: 3px solid">
                    <?php

                    if(isset($_SESSION['errorMessageForForgotPass'])){

                        echo $_SESSION['errorMessageForForgotPass'];
                        unset($_SESSION['errorMessageForForgotPass']);
                    }
                    ?>

                    <form action="../../views/process/data_process.php" method="post">

                        <div class="input-group mb-3">
                            <input type="password" name="password" required class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="repass" required class="form-control" placeholder="Re-type password">
                           <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <!-- <div class="icheck-primary">
                                     <input type="checkbox" id="remember">
                                     <label for="remember">
                                         Remember Me
                                     </label>
                                 </div>-->
                            </div>
                            <div class="col-4">
                                <button type="submit" name="change_user_pass" class="btn btn-primary btn-block">Confirm</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 btn-group">
                                <a class="btn btn-secondary  btn-group" href="login.php" >Login</a>
                                <a class="btn btn-success  btn-group" href="register.php" >New Register</a>
                            </div>

                        </div>


                    </form>


                </div>
            </div>
        </div>



    </div>
</div>





<div class="col-sm-4">

</div>
<div class="row">


</div>
</div>
<!--<div class="row">

</div>-->

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="../../contents/plugins/slick-1.8.1/slick-1.8.1/slick/slick.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--<script>
  $(document).ready(function(){
    $("#mySlider").slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });


    $("#mySlider2").slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
  });
</script>-->

</body>

</html>