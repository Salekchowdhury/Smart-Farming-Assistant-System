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



<div class="login-wrap">

    <div style="  margin-top: 30px; padding: 20px">
        <?php
        include_once '../google_translation/translation.php';
        if(isset($_SESSION['notFoundEmail'])){

            echo $_SESSION['notFoundEmail'];
            unset($_SESSION['notFoundEmail']);

        }
        ?>
        <h5>FORGOT PASSWORD<span style="color: #7c151f"></span></h5>

        <div class="login-form">
            <div class="sign-in-htm">

                <form action="../process/email.php" method="post">
                    <div class="group">

                        <input name="email" required placeholder=" Type Your Email....." style="width: 80%; height: 45px;  opacity: 1;border-radius: 15px;  border: none;
    outline: none;background-color: white;" type="text" class="">
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <div class="group">
                                <input type="submit" name="send_request" class="button" value="Send Request">

                            </div>

                        </div>
                        <div class="col-6" style="margin-top: 120px">
                            <img src="../../contents/img/forgot_password_icon.png" width="150" height="150" style="border-radius: 50%">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>



</div>


</body>
</html>