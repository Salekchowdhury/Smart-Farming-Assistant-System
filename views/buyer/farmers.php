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
    <title>Farmers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php
    include_once 'buyer_nav.php';
    ?>

    <aside style="background-image: linear-gradient(#5d3570, #bfa94d)" class=" main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light"><b>Smart Farming(Consumer)</b></span>
        </a>

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
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="farmers.php" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Farmers
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="manage_order.php" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Manage Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_notice.php" class="nav-link ">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>Admin Notice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="message.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Message</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact_us.php" class="nav-link">
                            <i class="nav-icon fas fa-phone"></i>
                            <p>Contact Us</p>
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
            <div class="container-fluid">
                <div class="row mb-2">
                    <?php
                    if(isset($_SESSION['updateMsg'])){
                        echo $_SESSION['updateMsg'];
                        unset($_SESSION['updateMsg']);
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="content wow rotateInDownLeft" data-wow-duration= "1s">
            <div class="row">
                <div class="col-md-12" >
                    <div class="card card-plain">

                        <div class="card-body">

                            <div class="row rounded " style="border-radius: 50%">

                                <?php
                                $lists=$datamanipulation->showAllShopData();
                                //var_dump($lists);
                                $s=1;

                                if($lists){
                                    foreach ($lists as $list){
                                        ?>
                                            <div class="col-3 p-1 m-5 text-center" style="background-image: linear-gradient(#5d3570, #bfa94d)">
                                                <div class="text-center">
                                                    <div class="">
                                                        <img style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); border-radius:50%;  height: 200px; width: 200px;" src="<?php echo $list->image?>" alt="Avatar" class="m-4 avatar mb-2">
                                                    </div>
                                                    <?php
                                                    $rateList = $datamanipulation->totalRating($list->user_id);
                                                    //var_dump($rateList);
                                                    $totalRatingAvg = $rateList[0]->averageRating;
                                                    $int = (int)$totalRatingAvg;

                                                    if($rateList){
                                                        for ($i=1;$i<6;$i++){
                                                            if($int>=$i){
                                                                echo "<i style='color: #AF0000' class=\"far fa-star \"></i>";
                                                            }else{
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <p><?php echo $list->address?></p>
                                                </div>
                                                <div class="text-justify">
                                                    <span class="text-light"> Name: <strong><?php echo $list->name?></strong></span> <br/>
                                                    <span class="text-light"> Phone: <strong><?php echo $list->phone?></strong></span> <br/>
                                                    <span class="text-light"> Email: <strong><?php echo $list->email?></strong></span> <br/>
                                                </div>
                                                <div class="btn-group mt-2">
                                                    <a href="../buyer/shop_details.php?shop_id=<?php echo $list->user_id?>" class="btn-group btn bg-success btn-outline-primary fancy" style="background-image: linear-gradient(#590c70, #bfa512)" data-type="iframe" > View</a>
                                                    <a href="../buyer/rating_profile.php?rating_user_id=<?php echo $list->user_id?>" class="btn-group btn bg-primary btn-outline-success fancy text-dark" style="background-image: linear-gradient(#9b95fb, #bbff0a)" data-type="iframe" > Rating</a>
                                                </div>
                                            </div>


                                        <?php
                                        $s++;
                                    }

                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script type="text/javascript">
</script>
</body>
</html>



