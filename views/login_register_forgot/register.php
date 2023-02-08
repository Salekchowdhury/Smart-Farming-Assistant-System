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
        if(isset($_SESSION['isExistMsg'])){

            echo $_SESSION['isExistMsg'];
            unset($_SESSION['isExistMsg']);

        }

        ?>
        <h2>SIGN UP<span style="color: #7c151f"></span></h2>
        <div class="login-form">
            <div class="sign-in-htm">
                <form action="../process/data_process.php" method="post" enctype="multipart/form-data">
                <div class="group">

                    <input required name="name"  autocomplete="off"  placeholder=" Full Name....." style="width: 80%; height: 45px;  opacity: 1;border-radius: 15px;  border: none;
    outline: none; " type="text">
                </div>
                  <div class="group">

                    <input required name="email" placeholder=" Email....." style="width: 80%; height: 45px;  opacity: 1;border-radius: 15px;  border: none;
    outline: none;background-color: white;" type="text" class="">
                </div>
                 <div class="group">

                     <select required  class="form-control"  name="position" style="width: 80%; height: 45px;  opacity: 1;border-radius: 15px;  border: none;
    outline: none;background-color: white;">
                         <option value="">Select your position</option>
                         <option value="Seller">Farmer</option>
                         <option value="Buyer">Consumer</option>
                         <option value="Expert">Expert</option>
                     </select>
                </div>


                <div class="group">

                    <input required name="password" placeholder=" Password...." type="password" class="" data-type="password"  style="width: 80%; opacity: 1;height: 45px;  border-radius: 15px;  border: none;
    outline: none;background-color: white">
                </div>
                  <div class="group">

                      <input required style="margin-left: 12px" required type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                </div>
               <div class="row">
                   <div class="col-12">
                       <div class="group">
                           <input type="submit" class="button" name="signup" value="Sign Up">

                       </div>
                   </div>
               </div>
                </form>
                <div class="row">


                    <div class="col-6">
                        <div class="group">
                            <div class="hr"></div>
                            <div class="">
                                <a href="login.php">already have an account</a>
                            </div>

                        </div>

                    </div>
                    <div class="col-6" style="margin-top: 120px">
                        <img src="../../contents/img/sf.png" width="150" height="150" style="">
                    </div>
                </div>


            </div>

        </div>
    </div>



</div>


</body>
</html>