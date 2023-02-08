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
                        <a href="payment.php" class="nav-link">
                            <i class="nav-icon fas fa-phone"></i>
                            <p>Payment</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaction.php" class="nav-link active">
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
        <section class="content-header">
            <div>

            </div>

            <div class="col-12 text-light">
                <div class="card" style="background-image: linear-gradient(#0c0970, #4cbf15)">
                    <div class="card-body">
                        <table id="rafia1" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: cornflowerblue;background-color: bisque;">
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Transaction Id</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php


                            $lists=$datamanipulation->showAllTransactionById($user_id);
                            if($lists){
                                foreach ($lists as $list){
                                    ?>
                                    <tr>
                                        <td style="color: white"><?php echo $list->name?></td>
                                        <td style="color: white"><?php echo $list->phone?></td>
                                        <td style="color: white"> <?php echo $list->amount?></td>
                                        <td style="color: white"> <?php echo $list->transaction_id?></td>
                                        <td style="color: white"> <?php echo $list->date?></td>

                                        <td>
                                            <?php
                                            if($list->status == 'yes'){
                                                ?>
                                                <a style="color: white" href=""title="" class="btn  btn-secondary btn-outline-danger bg-black disabled"><i class="fas fa-check-circle"></i> ACCEPTED</a>
                                                <?php
                                            }else{
                                                ?>

                                                <a style="color: white" href=""title="" class="btn  btn-secondary btn-outline-danger bg-black disabled"><i class="fas fa-check-circle"></i>PENDING</a>                                                <?php
                                            }
                                            ?>


                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>




        </section>

    </div>


</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>

</body>
</html>



