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
$checkid = $_SESSION['checkBack'];
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
            <h1>Profile Information</h1>
          </div>

        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="">

            <div style="height: 96%" class="card card-primary card-outline ">

            </div>

          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div style="height: 96%" class="card ">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <div class="card-body box-profile">
                    <div class="text-center">
                        <?php
                        if(isset($_GET['view_building_woner_profile_by_email'])){
                            $data =$datamanipulation->view_building_woner_profile_by_email($_GET['view_building_woner_profile_by_email']);
                            $checkEmail=$datamanipulation->checkValid($_GET['view_building_woner_profile_by_email']);
                        }
                        ?>
                      <img class="profile-user-img img-fluid img-circle"
                           src="<?php echo $data->image?>"
                           alt="User profile picture">
                    </div>

                    <p class="text-muted text-center"><?php echo $data->profession?></p>
                    <h3 class="text-muted text-center">Bio</h3>
                    <p class="text-muted text-center"><?php echo $data->bio?></p>

                  </div>

                </ul>
                  <?php

                  if(isset($_SESSION['updatetMsg'])){
                      echo $_SESSION['updatetMsg'];
                      unset($_SESSION['updatetMsg']);
                  }
                  ?>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Name:</label><span> <b style="font-size: 28px;"><?php echo $data->name?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Email:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->email?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Phone:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->phone?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">User Type:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->type?></b></span>

                      </div>

                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Road No:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->road_no?></b></span>

                      </div>
                        <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Works Details:</label><span class=""> <b style="font-size: 28px;"><?php echo $data->work?></b></span>

                      </div>
                      <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Total Post:</label><span class=""> <b style="font-size: 28px;"><?php echo 05?></b></span>

                      </div>


                           <div class="row">
                               <div class="col-sm-12">
                                   <a style="color: white" class="btn btn-success  btn-outline-primary " href="message.php" >BACK</a>
                                   <!--<a  style="color: white" class="btn btn-success  btn-outline-secondary  btn-group" href="../process/employee_process.php?employee_confirmId=<?php /*echo $data->user_id*/?>" >CONFIRM</a>-->




                               </div>

                           </div>


                    </form>
                  </div>

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Sohag</a>.</strong>
    All rights reserved.

  </footer>
  <aside class="control-sidebar control-sidebar-dark">
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../contents/plugins/jquery/jquery.min.js"></script>
<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>
<script src="../../contents/js/demo.js"></script>
</body>
</html>
