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
//$registration =new registration();
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
<div class="row">


</div>

<div class="row">


    <div class="col-sm-8" style="margin-left: 500px;padding-top: 45px; ">

        <div class="">
            <div class="">

            </div>
            <div class="" <!--style="border-bottom-left-radius: 45px;-->
    border-top-right-radius: 45px;">
                <div class=" " <!--style="border-bottom-left-radius: 45px;-->
    border-top-right-radius: 45px; border: 3px solid">

                    <form  action="../../views/process/verify.php" method="post" style=" background-color: black;display: inline-block;margin-left: 10px;margin-top: 106px;border: 2px solid;border-radius: 13px;padding: 84px; margin: auto">
                        <?php
                        if(isset($_SESSION['errorMesseage'])){
                            echo $_SESSION['errorMesseage'];
                            unset($_SESSION['errorMesseage']);
                        }
                        include_once '../google_translation/translation.php';
                        ?>
                        <h4 style="color: #00cd5a">Please Check Your Email</h4>
                        <h5 style="color: #00cd5a"><?php echo $email?></h5>

                        <input type="text" class="form-control" placeholder="New Password" name="password" class="text_box">
                        <br>
                     <input type="text" class="form-control" placeholder="O.T.P" name="otp" class="text_box">
                     <input type="hidden"  name="email" value="<?php echo $email?>">
                        <br>

                        <button type="submit" class="button btn btn-primary" name="confirmForgotPassword">Confirm</button>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 btn-group">
                                <a class="btn btn-primary  btn-group" href="login.php" >Login</a>
                                <a class="btn btn-secondary  btn-group" href="register.php" >New Register</a>
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