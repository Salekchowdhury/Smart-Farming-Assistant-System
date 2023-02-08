<?php
if (!isset($_SESSION)){
    session_start();
    $userEmail=$_SESSION['email'];
    $userName=$_SESSION['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="main ">
    <div class="row">
    <section class="signup mb-0">
        <div class="container" style="border: 2px solid #a71d2a;margin-top: 60px; background-image: linear-gradient(#556270, #0e4821)">
            <marquee direction="left" height="100" width="1115"><h2 style="color: white;margin-top: 30px">Smart Farming Assistant System</h2></marquee>

                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="signup-content">
                        <div class="signup-form">
                            <?php
                            if (isset($_SESSION["WronMsg"])){
                                echo $_SESSION["WronMsg"];
                                unset($_SESSION["WronMsg"]);
                            }
                            include_once '../google_translation/translation.php';
                            ?>
                            <form action="../process/data_process.php" method="post" class="register-form" id="register-form">

                                <h6 style="color:white"><?php echo $userName?>  Please Check Your Mail <br/> <strong style="color: #2626ff"> <?php echo $userEmail?></strong> </h6>

                                <input type="number" class="form-control" placeholder="Enter Confirmation Code" name="code" class="text_box w-25">
                                <input type="hidden" class="form-control"  name="email" value="<?php echo $userEmail?>">
                                <br>
                                <button type="submit" class="button btn btn-primary" name="confirm">Confirm</button>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a style="color: white" class="btn btn-success  btn-outline-primary" href="register.php" >New Register</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="signup-image" style="margin-top: 10px">
                            <a href="login.php" class="signup-image-link">I have an account</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
        </div>
    </section>
    </div>
</div>

<script src="../contents/js/jquery-3.2.1.min.js"></script>
<script src="../contents/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../contents/js/jquery.magnific-popup.min.js"></script>
<script src="../contents/plugins/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="../contents/js/main_custom.js"></script>
</body>
</html>