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
$data=$datamanipulation->showAdminDataById($user_id);

$phone=$data->phone;

include_once '../../views/Admin/adminHeader.php';
?>
<div class="wrapper">
    <?php
    include_once 'admin_nav.php';
    ?>

    <aside class="main-sidebar sidebar-dark-blue elevation-4" style="background-image: linear-gradient(#0c0970, #4cbf15); position: fixed">

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <?php
                if($data->image){
                    ?>
                    <img  src="<?php echo $data->image?>" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }else{
                    ?>
                    <img  src="../../contents/img/f4.png" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }
                ?>


                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $data->name?>(Admin)</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link">
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
                        <a href="leader_board.php" class="nav-link active">
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
        <section class="content-header">
            <div>
                <?php
                if (isset($_SESSION["status"])){
                    echo $_SESSION["status"];
                    unset($_SESSION["status"]);
                }

                ?>
            </div>

            <div class="col-12 text-light">
                <div class="card" style="background-image: linear-gradient(#0c0970, #4cbf15)">
                    <div class="card-body">
                        <table id="rafia1" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: cornflowerblue;background-color: bisque;">
                                <th>SL#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Rating</th>
                                <th>Sell Item</th>
                                <th>Action</th>
                                <th>Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php


                            $lists=$datamanipulation->showAllRatingGroupBy();
//                            var_dump($lists);
                            if($lists){
                                $s=1;
                                foreach ($lists as $list){

                                    $userData = $datamanipulation->showBuyerDataById($list->user_id);

                                    $giftData = $datamanipulation->checkGift($list->user_id);
                                    $countTotalSell = $datamanipulation->countTotalSell($list->user_id);
//var_dump($countTotalSell->total);
                                    ?>
                                    <tr>

                                        <td style="color: white"><?php echo $s++?></td>
                                        <td style="color: white"><?php echo $userData->name?></td>
                                        <td style="color: white"><?php echo $userData->phone?></td>
                                        <td style="color: white">

                                            <?php
                                            $totalRating = $list->Rating;
                                            $totalRatingAvg = $totalRating/$list->Users;
                                            $int = (int)$totalRatingAvg;

                                            for ($i=1;$i<6;$i++){
                                                if($int>=$i){
                                                    echo "<i style='color: #BBFF0A' class=\"far fa-star \"></i>";
                                                }else{
                                                    echo "<i class=\"far fa-star\"></i>";
                                                }
                                            }
                                            ?>
                                            (<?php echo $list->Users?>)
                                            <?php
                                            ?>

                                        </td>
                                         <td>
                                             <?php echo $countTotalSell->total?>
                                         </td>
                                        <td>
                                            <a style="color: white" href="mail_to_seller.php?shop_id=<?php echo $list->user_id?>"title="Email" class="btn  btn-success btn-outline-primary"><i class="fa fa-envelope"></i>  EMAIL</a>

                                        </td>
                                        <?php
                                        if($giftData){
                                            ?>
                                          <td>
                                             <span class="font-size-20 text-white">(<?php echo $giftData->position?> Position)</span> <a href="../process/admin_process.php?delete_gift=<?php echo $giftData->id?>" class="btn text-white btn-primary btn-danger btn-outline-success">DELETE</a>

                                          </td>
                                            <?php
                                        }else{
                                            ?>
                                            <td>
                                                <div class="">
                                                    <form action="../process/admin_process.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $list->user_id?>">
                                                        <select required class=" p-2" name="position" style="border-radius: 25px">
                                                            <option value="">Select Option</option>
                                                            <option value="1st">1st</option>
                                                            <option value="2nd">2nd</option>
                                                            <option value="3rd">3rd </option>
                                                        </select>
                                                        <button type="submit" name="add_position" class="btn btn-primary bg-dark btn-outline-success">SUBMIT</button>
                                                    </form>

                                                </div>
                                            </td>
                                            <?php
                                        }
                                        ?>

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
        $("#rafia1").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#rafia2").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#rafia3").DataTable({
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

        $('#rafia').DataTable({
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


