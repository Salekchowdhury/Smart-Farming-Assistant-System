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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>

    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php
    include_once 'expert_nav.php';
    ?>

    <aside style="background-color: rgba(12,73,38,0.78);background-image: linear-gradient(#556270, #ff6b6b)" class=" main-sidebar sidebar-dark-primary elevation-4">

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
                        <a href="profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="add_post.php" class="nav-link active">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>
                                Post
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="message.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Message</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="notice.php" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>Notice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact_us.php" class="nav-link ">
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

    <div class="content-wrapper" style="background-image: linear-gradient(#ff6b6b ,#556270 )">
        <section class="content-header">
            <?php
            if(isset($_SESSION['add_post'])){
                echo $_SESSION['add_post'];
                unset($_SESSION['add_post']);
            }
            if(isset($_SESSION['deleteMsg'])){
                echo $_SESSION['deleteMsg'];
                unset($_SESSION['deleteMsg']);
            }
            ?>
            <div class="row">

                <div class="col-12">

                    <form  role="form "  action="../process/data_process.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">

                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="form-control-label">Title:</label>
                                            <input type="text"   name="title" class="form-control"  value="">
                                            <input type="hidden"  name="name"  value="<?php echo $profileData->name?>">
                                            <input type="hidden"  name="user_id"  value="<?php echo $user_id?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="form-control-label">Image</label>
                                            <input required type="file" name="image" accept="image/x-png,image/gif,image/jpeg">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label class="form-control-label">post:</label>
                                            <textarea cols="5" rows="5" type="text" name="post" required class="form-control"  value=""></textarea>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success w-100 ml-3 mb-2"  name="add_post" value="Add Post" style="font-size: 21px; background-image: linear-gradient(#ff6b6b ,#556270 ); text-align: center;border: 1px solid;border-radius: 25px;" >
                                            <!--                                          <input type="submit" class="btn btn-primary" required  name="message_send_by_expert" value="Send Message">-->
                                        </div>
                                    </div>
                                </div>


                            </fieldset>
                        </div>




                        <!--<div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>-->
                    </form>
                </div>
            </div>

         <div class="row container ">
             <div class="w-100">

                 <?php
                 $lists =$datamanipulation->showAllPostById($user_id);
//                 var_dump($lists);
                 if($lists){
                     foreach ($lists as $list){
                         ?>
                 <div class=" rounded p-4 mt-2" style="background-image: linear-gradient(#ff7e60 ,#556270 )">
                             <div class="row">
                                 <div class="col-md-9">
                                     <h4 class="text-light">Title</h4>
                                     <strong  class="text-light"><?php echo $list->title?></strong>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="row">
                                         <div class="col-md-6">
                                             <a  href="edit_post.php?edit_post_id=<?php echo $list->no?>" class=" bg-dark btn btn-success form-control editPost text-light" ><i class="far fa-edit"></i> Edit</a>
                                         </div>
                                         <div class="col-md-6">
                                             <a href="../process/data_process.php?delete_post_id=<?php echo $list->no?>"  class="bg-dark btn btn-primary form-control" name="add_card"><i class="text-danger fas fa-trash"></i> Delete</a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="mt-3 text-light">
                                 <p class="text-justify"><?php echo $list->post?></p>
                             </div>
                     <div class="">
                         <img src="<?php echo $list->image?>" width="550px" height="350px">
                     </div>
                           </div>
                         <?php
                     }
                     }
                 ?>

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
</body>
</html>



