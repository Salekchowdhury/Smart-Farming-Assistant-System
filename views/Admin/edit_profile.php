
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
$profileData=$datamanipulation->showAdminDataById($user_id);
include_once ('../seller/sellerHeader.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
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
    include_once 'admin_nav.php';
    ?>

    <aside class="main-sidebar sidebar-dark-blue elevation-4" style="background-image: linear-gradient(#0c0970, #4cbf15); position: fixed">

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <?php
                if($profileData->image){
                    ?>
                    <img  src="<?php echo $profileData->image?>" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }else{
                    ?>
                    <img  src="../../contents/img/f4.png" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }
                ?>


                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $profileData->name?>(Admin)</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link active">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pending_account.php" class="nav-link">
                            <i class="nav-icon  fas fa-calendar-check"></i>
                            <p>Pending Account</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="manage_users.php" class="nav-link ">
                            <i class="nav-icon fas fa-user-cog"></i>

                            <p>
                                Manage Users

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="manage_expert.php" class="nav-link ">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Manage Expert
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transaction_history.php" class="nav-link ">
                            <i class="nav-icon fas fa-money-bill-alt"></i>
                            <p>Transaction</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="add_category.php" class="nav-link ">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>
                                Add Category
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="shop_details.php" class="nav-link ">
                            <i class="nav-icon fas fa-shopping-bag"></i>

                            <p>
                                Shop Details
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="notice.php" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>

                            <p>
                                Notice
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="leader_board.php" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>

                            <p>
                                Leaderboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="message.php" class="nav-link">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Message
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="create_admin.php" class="nav-link ">
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>
                                Create Admin
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../views/process/admin_process.php?logout=1" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Logout</p>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #3c763d"> Edit Profile</h1>
                    </div>
                    <?php
                    if (isset($_SESSION["UdateMsg"])){
                        echo $_SESSION["UdateMsg"];
                        unset($_SESSION["UdateMsg"]);
                    }
                    if (isset($_SESSION["UpdatePass"])){
                        echo $_SESSION["UpdatePass"];
                        unset($_SESSION["UpdatePass"]);
                    }
                    if (isset($_SESSION["uploadImage"])){
                        echo $_SESSION["uploadImage"];
                        unset($_SESSION["uploadImage"]);
                    }
                    ?>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <form action="../process/seller_process.php" method="post" enctype="multipart/form-data" >

            <section class="content">
                <div class="px-2">
                    <div class="row bg-light">
                        <div class="col-11">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">
                                    <div class="row">
                                        <div class="col-8">
                                            <?php
                                            if($profileData->image){
                                                ?>
                                                <img style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); border-radius:50%;  height: 200px; width: 200px;" src="<?php echo $profileData->image?>" alt="Avatar" class="m-4 avatar mb-2">
                                                <?php
                                            }else{
                                                ?>
                                                <img style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); border-radius:50%;  height: 200px; width: 200px;" src="../../contents/img/f4.png" alt="Avatar" class="m-4 avatar mb-2">
                                                <?php
                                            }
                                            ?>
                                            <input type = 'hidden' name="id"  value="<?php echo $user_id?>">
                                            <br>
                                            <input class="ml-2"  type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">
                                            <br>
                                            <br>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="tab-content">

                                <div class="tab-pane active" id="settings">
                                    <div class="row">
                                        <div class=" ml-3" >
                                            <div class="form-group row mt-3">
                                                <label  class="col-sm-2 col-form-label">Name:</label><span> <b style="font-size: 28px;"></b></span>
                                                <div class="col-sm-10">
                                                    <input type="name"  required class="form-control" name="name" value="<?php echo $profileData->name?>">
                                                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                                    <input type="hidden" name="type" value="admin">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Email:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                                <div class="col-sm-10">
                                                    <input type="email" required class="form-control" name="email" value="<?php echo $profileData->email?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-sm-2 col-form-label">Phone:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                                <div class="col-sm-10">
                                                    <input type="Phone" required class="form-control" name="phone" value="<?php echo $profileData->phone?>" >
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label  class="col-sm-3 col-form-label">Address:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                                <div class="col-sm-9">
                                                    <input type="text" required class="form-control" name="address" value="<?php echo $profileData->address?>" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label  class="col-sm-3 col-form-label">Password:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                                <div class="col-sm-9">
                                                    <input type="password" required class="form-control" name="new_password" value="<?php echo $profileData->password?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <input type="submit" class="mt-2 btn btn-success w-25 ml-3 mb-2"  name="ChangePhoto" value="Update" style="font-size: 21px;background-image: linear-gradient(#0c0970, #4cbf15); text-align: center;border: 1px solid;border-radius: 25px;" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="">

                            <!-- Profile Image -->
                            <div style="height: 96%" class="card card-primary card-outline ">

                            </div>

                        </div>
                        <!-- /.col -->


                        <!-- /.card -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
        </form>
    </div>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/plugins/chart.js/Chart.min.js"></script>
<script src="../../contents/plugins/sparklines/sparkline.js"></script>
<script src="../../contents/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../contents/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../contents/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../../contents/plugins/moment/moment.min.js"></script>
<script src="../../contents/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../contents/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../contents/plugins/summernote/summernote-bs4.min.js"></script>
<script src="../../contents/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../contents/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../contents/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../contents/js/adminlte.js"></script>
<script src="../../contents/js/pages/dashboard.js"></script>
<script src="../../contents/js/demo.js"></script>
</body>
</html>



