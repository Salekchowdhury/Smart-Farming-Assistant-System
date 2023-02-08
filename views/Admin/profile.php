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
    $phone=$profileData->phone;

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
        <section class="content">
            <div class="px-2">
                <div class="row bg-light">
                    <div class="col-md-6 mt-5">

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
                        </div>
                        <a href="edit_profile.php?profile_id=<?php echo $profileData->admin_id?>"  class="mt-2 btn btn-success w-25 ml-3 mb-2"  style="font-size: 21px;background-image: linear-gradient(#0c0970, #4cbf15); text-align: center;border: 1px solid;border-radius: 25px;" >EDIT</a>

                    </div>


                </div>
            </div>


        </section>
    </div>


  <!-- /.content-wrapper -->

  <aside class="control-sidebar control-sidebar-dark">
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../contents/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../contents/js/demo.js"></script>
<script src="../../contents/js/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>

</body>
</html>
