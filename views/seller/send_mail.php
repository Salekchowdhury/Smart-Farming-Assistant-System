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
                        <a href="my_shop.php" class="nav-link ">
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
                        <a href="profile.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
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
        <section class="content-header">
            <?php
            if(isset($_SESSION['SendMessage'])){
                echo $_SESSION['SendMessage'];
                unset($_SESSION['SendMessage']);
            }
            ?>
            <div class="row">
                <?php
                if(isset($_GET['order_id'])){

                    $orderData = $datamanipulation->showOrderDataByOrderId($_GET['order_id']);
                    $clientId=$orderData->user_id_To;
                    $sellerId=$orderData->user_id_From;
                    $mailer = $datamanipulation->showBuyerDataById($clientId);
                    $buyerData = $datamanipulation->showBuyerDataById($sellerId);
                    //var_dump($sellerData);
               //var_dump($mailer);
                    $confirmerEmail =$mailer->email;
                    $confirmerName =$mailer->name;
                }
                ?>
                <div class="col-sm-5">

                    <form style="padding-top: 20px" role="form "  action="../process/email.php" method="post">
                        <div class="card-body">

                            <fieldset>

                                <div class="form-group ">
                                    <label class="form-control-label">Name:</label>
                                    <input type="text" name="name" required disabled class="form-control"  value="<?php echo $profileData->name?>">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Gmail:</label>
                                    <input type="email" required   disabled class="form-control"  value="<?php echo $profileData->email?>">
                                    <input type="hidden"   name="email"  class="form-control"  value="<?php echo $buyerData->email?>">

                                    <input type="hidden"   name="order_id"  class="form-control"  value="<?php echo $orderData->no?>">
                                    <input type="hidden"   name="client_name"  class="form-control"  value="<?php echo $orderData->name?>">
                                    <input type="hidden"   name="pnumber"  class="form-control"  value="<?php echo $orderData->pnumber?>">
                                    <input type="hidden"   name="item"  class="form-control"  value="<?php echo $orderData->item?>">
                                    <input type="hidden"   name="address"  class="form-control"  value="<?php echo $orderData->address?>">
                                    <input type="hidden"   name="product"  class="form-control"  value="<?php echo $orderData->product?>">
                                    <input type="hidden"   name="units"  class="form-control"  value="<?php echo $orderData->units?>">
                                    <input type="hidden"   name="date"  class="form-control"  value="<?php echo $orderData->date?>">

                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Subject:</label>
                                    <input type="text" name="subject" required class="form-control"  value="">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label">Message </label>
                                    <textarea class="form-control" required name="message" rows="8" cols="15" placeholder="Type Your Message...."></textarea>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <a style="color: white"  href="order_history.php"title="Back" <i class=" btn btn-success btn-outline-primary fas fa-chevron-circle-left" ></i> BACK</a>
                                        <input type="submit" class="btn btn-primary" required  name="message_send_to_client" value="Send Message">

                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </form>
                </div>

                <div class="col-sm-5" style="margin-top: 70px;border-color: #00b44e; border: 3px dashed; border-radius: 15px">
                    <h2 style="color: #00b44e">Order Details</h2>
                    <div style="margin: 20px">
                        <p> <b>Name: </b> <?php echo $orderData->name?></p>
                        <p> <b>Phone: </b> <?php echo $orderData->pnumber?></p>
                        <p> <b>iteam: </b> <?php echo $orderData->item?></p>
                        <p> <b>Address: </b> <?php echo $orderData->address?> </p>
                        <p> <b>Product: </b> <?php echo $orderData->product?> </p>
                        <p> <b>Units: </b> <?php echo $orderData->units?> </p>
                        <p> <b>Date: </b> <?php echo $orderData->date?> </p>
                        <p> <b>Email: </b> <?php echo $buyerData->email?> </p>
                    </div>

                </div>
                <div class="col-sm-2">

                </div>

            </div>




        </section>



        <footer>

        </footer>
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



