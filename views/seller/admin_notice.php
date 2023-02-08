
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
                        <a href="profile.php" class="nav-link ">
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
                        <a href="admin_notice.php" class="nav-link active">
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12" >
                        <div class="callout callout-info " style="background-image: linear-gradient(#556270, #ff6b6b)">
                            



                            <h2 class="text-center" style="color: darkorange"> Notice Bord</h2>
                            <?php
                            $notices =$datamanipulation->showAllNotice();
                            foreach ($notices as $notice ){
                                $note=$notice->notice;

                                $date=$notice->date;
                                $dateArray = explode("-",$date);

                                $dateRevers= array_reverse($dateArray);
                                $dateString = implode("-", $dateRevers);
                                ?>
                                <div class="row" >
                                    <!-- <div class="col-8"><b><?php /*$date = $lists->date; echo  date(' m/d/Y', strtotime($date)); $time = $lists->time; echo"   ". date('h:i:s a' , strtotime($time));*/?></b></div>
-->
                                    <div class=""> </div>
                                    <div class="col-6 text-light"> <?php echo $dateString?> (<span style="color: #7c151f; font-size: 18px"><?php echo "   ". date('h:i:s a' , strtotime($notice->time))?></span>)</div>


                                </div>
                                <!--<div class="mb-5 mr-5 d-flex justify-content-end">9/5/2020</div>-->
                                <strong class="text-light pb-4" style="text-align: justify;margin-bottom: 50px;">
                                    <?php echo $notice->title?>
                                </strong>
                                <p class="text-light mt-2" style="text-align: justify;margin-bottom: 50px; border-bottom: 2px solid #0b2e13">
                                    <?php echo $note?>
                                </p>
                                <?php
                            }

                            //var_dump($notice);
                            ?>


                        </div>

                    </div>
                </div>
            </div>
        </section>

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



