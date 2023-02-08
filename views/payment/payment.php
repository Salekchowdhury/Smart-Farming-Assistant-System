<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$datamanipulation = new DataManipulation();
use App\Utility\Utility;

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$profileData=$datamanipulation->showBuyerDataById($user_id);
$phone=$profileData->phone;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Smart Farming</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php
    include_once 'payment_nav.php';
    ?>

    <aside style="background-color: rgba(12,73,38,0.78)" class=" main-sidebar sidebar-dark-primary elevation-4">


        <div class="sidebar" style="position: fixed">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">


                    <?php
                    if($profileData->image){
                        ?>
                        <img  src="<?php echo $profileData->image?>" class="img-circle elevation-2"  alt="User Image">
                        <?php
                    }else{
                        ?>
                        <img  src="../../contents/img/f5.png" class="img-circle elevation-2"  alt="User Image">
                        <?php
                    }
                    ?>


                </div>
                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Contact</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="payment.php" class="nav-link active">
                            <i class="nav-icon fas fa-phone"></i>
                            <p>Payment</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaction.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Transaction</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="../process/seller_process.php?logout=1" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="">

            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card card-user">
                        <div class="card-header">
                            <h2 class="">Paymnet</h2>
                        </div>
                        <?php

                        if(isset($_SESSION['donationMsg'])){
                            echo $_SESSION['donationMsg'];
                            unset($_SESSION['donationMsg']);
                        }
                        ?>

                        <div class="card-body bg-info">
                            <form action="../process/data_process.php" autocomplete="off" method="post">
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">

                                            <label>Name</label>
                                            <input type="text"  value="" class="form-control" name="name" placeholder="Name">
                                            <input type="hidden"  value="<?php echo $user_id?>"  name="user_id">
                                        </div>
                                    </div>

                                    <div class="col-md-4 px-1">
                                        <div class="form-group">
                                            <label>Add payment Amount</label>
                                            <input type="number" required name="amount" class="form-control" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>Phone Number<b>(bkash)</b></label>
                                            <input type="number" required class="form-control" name="phone" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="alert alert-default-primary alert-dismissible fade show text-black-50" >Transaction ID (Send Money through Bkash to the following number, and give the transaction ID.)</label>
                                            <h2 class="mb-0">Bkash Agent Number <strong>(+880 1879-727083)</strong></h2>

                                            <label>Transaction ID </label>
                                            <input type="text" class="form-control" required name="transaction_id" placeholder="Transaction Number">
                                        </div>
                                    </div>

                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date"  required class="form-control" name="date" placeholder="Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="update col-md-6 mr-auto">
                                        <button type="submit" name="payment_send" class="btn btn-primary">Send</button>
                                        <a href="../login_register_forgot/login.php" name="payment_send" class="btn btn-success">Back</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>

</body>
</html>



