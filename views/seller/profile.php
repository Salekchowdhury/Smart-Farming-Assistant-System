
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
$profileData=$datamanipulation->showSellerAccount($user_id);
include_once ('../seller/sellerHeader.php');
?>
<div class="wrapper">
    <?php
    include_once 'seller_nav.php';
    ?>

    <aside style="background-color: rgba(116,12,41,0.6)" class="student-bg main-sidebar sidebar-dark-primary elevation-4">

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <?php
                if($profileData->image) {
                ?>

                    <img src="<?php echo $profileData->image?>" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }else{
                    ?>
                    <img src="../../contents/img/f5.png" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }
                ?>

                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $profileData->name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link active">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="seller_home.php" class="nav-link ">
                            <i class="nav-icon fas fa-house-damage"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="add_item.php" class="nav-link ">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                My Shop
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="expert.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Expert
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="order_history.php" class="nav-link ">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Manage Order
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="message.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Consumers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="admin_notice.php" class="nav-link ">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>
                                Admin Notice
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="contact_us.php" class="nav-link ">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Contact Us
                            </p>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="color: #3c763d"> Your Profile</h1>
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
<!--        <form action="../process/seller_process.php" method="post" enctype="multipart/form-data" >-->

        <section class="content">
            <div class="px-2">
                <div class="row bg-light">
                    <div class="col-md-6">

                        <?php
                        if($profileData->image){
                            ?>
                            <img style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); border-radius:50%;  height: 200px; width: 200px;" src="<?php echo $profileData->image?>" alt="Avatar" class="m-4 avatar">
                            <?php
                        }else{
                            ?>
                            <img style="box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23); border-radius:50%;  height: 200px; width: 200px;" src="../../contents/img/f4.png" alt="Avatar" class="m-4 avatar ">
                            <?php
                        }
                        ?>
                        <?php
                        $rateList = $datamanipulation->totalRating($user_id);
                        //var_dump($rateList);
                        $totalRatingAvg = $rateList[0]->averageRating;
                        $totalClient = $rateList[0]->totalClient;
                        $int = (int)$totalRatingAvg;
                        $totalClient = (int)$totalClient;

                        if($rateList){
                            ?>
                            <br>
                            <?php


                            for ($i=1;$i<6;$i++){
                                if($int>=$i){
                                    echo "<i style='color: #AF0000' class=\"far fa-star \"></i>";
                                }else{

                                }
                            }
                            ?>
                            <br>
                            <?php
                            echo "<b class='ml-3'>($totalClient)</b>";
                        }
                        ?>


                        <input type = 'hidden' name="id"  value="<?php echo $user_id?>">
                        <br>
                        <!--                                        <input class="ml-2"  type="file" name="photo" accept="image/x-png,image/gif,image/jpeg">-->
                        <br>
                        <br>


                        <div class=" ml-3" >
                            <div class="form-group row mt-3">
                                <label  class="col-sm-2 col-form-label">Name:</label><span> <b style="font-size: 28px;"></b></span>
                                <div class="col-sm-10">
                                    <p  class="col-form-label"><?php echo $profileData->name?></p>
                                    <!--                                                <input type="name"  required class="form-control" name="name" value="--><?php //echo $profileData->name?><!--">-->
                                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Email:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                <div class="col-sm-10">
                                    <p  class="col-form-label"><?php echo $profileData->email?></p>
                                    <!--                                                <input type="email" required class="form-control" name="email" value="--><?php //echo $profileData->email?><!--">-->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Phone:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                <div class="col-sm-10">
                                    <p  class="col-form-label"><?php echo $profileData->phone?></p>
                                    <!--                                                <input type="Phone" required class="form-control" name="phone" value="--><?php //echo $profileData->phone?><!--" >-->
                                </div>
                            </div>


                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Address:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                <div class="col-sm-10">
                                    <p  class="col-form-label"><?php echo $profileData->address?></p>
                                    <!--                                                <input type="text" required class="form-control" name="address" value="--><?php //echo $profileData->address?><!--" >-->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">Shop Name:</label><span class=""> <b style="font-size: 28px;"></b></span>
                                <div class="col-sm-10">
                                    <p  class="col-form-label"><?php echo $profileData->shop_name?></p>
                                    <!--                                                <input type="text" required name="shop_name" class="form-control" value="--><?php //echo $profileData->shop_name?><!--" >-->
                                </div>

                            </div>
                        </div>
                        <a href="edit_profile.php?profile_id=<?php echo $profileData->user_id?>"  class="mt-2 btn btn-success w-25 ml-3 mb-2"  style="font-size: 21px;background-image: linear-gradient(#556270, #ff6b6b); text-align: center;border: 1px solid;border-radius: 25px;" >EDIT</a>

                    </div>


                </div>
            </div>


        </section>
<!--        </form>-->
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
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>
</body>
</html>



