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
 $_SESSION['checkBack']=1;
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
                                Profile(Farmer)
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
                        <a href="order_history.php" class="nav-link active">
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
        <section class="content-header" style="background-color: rgba(116,12,41,0.6)">
            <div>

            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h3>My Order History</h3>
                        <?php

                        if(isset($_SESSION['updatetMsg'])){
                            echo $_SESSION['updatetMsg'];
                            unset($_SESSION['updatetMsg']);
                        }
                        if(isset($_SESSION['confirmMSG'])){
                            echo $_SESSION['confirmMSG'];
                            unset($_SESSION['confirmMSG']);
                        }
                        ?>

                        <table id="sohag1" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: white;background-color: rgba(116,12,41,0.6);position:;">
                                <th>Serial</th>
                                <th>Product Name</th>
                                <th>Number</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
<!--                                <th>Delivery Date</th>-->
                                <th>Payment Method</th>
                                <th>Transaction ID</th>
                                <th>Price</th>

                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lists=$datamanipulation->showMyOrderHistoryById($user_id);
                                $s=1;
                                foreach ($lists as $list){
                         $buyerData= $datamanipulation->showBuyerDataById($list->seller_id)
                                    ?>
                                    <tr>
                                        <td><?php echo $s?></td>
                                        <td><?php echo $list->name?></td>
                                        <td><?php echo $list->phone?></td>
                                        <td><?php echo $list->quantity?></td>
                                        <td><?php echo $list->confirm_date?></td>
<!--                                        <td>--><?php //echo $list->confirm_date?><!--</td>-->
                                        <td><?php if($list->transaction_id){
                                            echo "Bkash";
                                            }else{
                                            echo "Cash on Delivery";
                                            }?></td>
                                        <td><?php echo $list->transaction_id?></td>
                                        <?php
                                        if($list->uprice){
                                            ?>
                                            <td><?php echo $list->uprice ?></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><?php echo $list->price ?></td>
                                            <?php
                                        }
                                        ?>


                                        <td>
                                            <?php
                                            ?>
                                            <a class="bg-dark btn btn-outline-success"  href="buyer_profile.php?buyer_id=<?php echo $list->buyer_id?>" <i class=" disabled btn btn-success btn-outline-primary far fa-check-circle" aria-hidden="true"></i> BUYER</a>
                                            <?php

                                            if($list->confirm_status=='yes'){
                                                ?>
                                                <a style="color: red"  href="" <i class=" disabled btn btn-success btn-outline-primary far fa-check-circle" aria-hidden="true"></i> CONFIRMED</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a style="color: white"  href="confirm_history.php?cart_id=<?php echo $list->cart_id?>"title="Confirm Order" <i class=" btn btn-success btn-outline-primary far fa-check-circle" aria-hidden="true"></i> CONFIRM</a>
                                                <?php
                                            }
                                            ?>





                                        </td>
                                    </tr>
                                    <?php
                                    $s++;
                                }
                                ?>




                            </tbody>

                        </table>
                    </div>
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

<script>
    $(function () {
        $("#sohag1").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag2").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag3").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        $('#sohag').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
</body>
</html>


