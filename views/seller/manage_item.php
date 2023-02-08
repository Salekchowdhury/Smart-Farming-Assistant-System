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
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="card card-widget widget-user shadow">
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username"><?php echo $profileData->name ?></h3>
                                <h5 class="widget-user-desc">Seller</h5>
                            </div>
                            <div class="widget-user-image">
                                <?php
                                if($profileData->image){
                                    ?>
                                    <img style="width: 6.1rem; height: 6.1rem" src="<?php echo $profileData->image?>" class="img-circle elevation-2" alt="User Image">

                                    <?php
                                }else{
                                    ?>
                                    <img style="width: 6.1rem; height: 6.1rem" src="../../assets/img/ok-2B.jpg" class="img-circle elevation-2" alt="User Image">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?php
                                                $value = $datamanipulation->getPostDataToShow($user_id);
                                                $count = 0;
                                                if($value){
                                                    foreach ($value as $values){
                                                        $count++;
                                                    }
                                                    echo $count;
                                                }
                                                else{
                                                    echo $count;
                                                }
                                                ?></h5>
                                            <span class="description-text">Total Items</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-8 timeline">
                        <?php
                        $listOfValues = $datamanipulation->getPostDataToShow($user_id);
                        if ($listOfValues){
                            foreach ($listOfValues as $listOfValues){
                                ?>

                                <div class="time-label">
                                    <span class="bg-red"><?php echo $listOfValues->date?></span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?php echo $listOfValues->time?></span>
                                        <h3 class="timeline-header"><?php echo $listOfValues->name?></h3>

                                        <div class="timeline-body">
                                            <p style="color:black!important;font-weight: bold; font-size: 30px"><?php echo $listOfValues->title ?></p>
                                            <p style="color:black!important;"><?php echo nl2br($listOfValues->post) ?></p>
                                            <!--<img width="580px" height="400px" src="<?php /*echo $listOfValues->image */?>">-->
                                            
                                            <img class="rounded" width="580px" height="400px" src="<?php echo $listOfValues->image?>" />
                                             

                                        </div>
                                        <div class="timeline-footer">
                                            <a data-id = "<?php echo $listOfValues->no ?>"class="btn btn-primary btn-sm editPost" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="../process/data_process.php?managePostDelete=<?php echo $listOfValues->no; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                                        </div>

                                    </div>
                                </div>

                                <?php

                                 if ($listOfValues->commentNo == NULL ){
                                     $comment = $datamanipulation->viewPostComment($listOfValues->no);
                                     foreach ($comment as $comments){
                                         if($listOfValues->no == $comments->commentNo ) {
                                             ?>
                                             <div>
                                                 <i class="fas fa-comments bg-yellow"></i>
                                                 <div class="timeline-item">
                                                     <span class="time"><i class="fas fa-clock"></i> <?php echo $comments->date," ",$comments->time ; ?></span>
                                                     <h3 class="timeline-header"><?php echo "<b>", $comments->name,"</b>"; ?></h3>
                                                     <div class="timeline-body">
                                                         <?php echo $comments->post; ?>
                                                     </div>
                                                 </div>
                                             </div>
                                             <?php
                                         }
                                     }
                                 }
                                ?>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <div class=" d-flex justify-content-center mt-5">
                                <h1>You Have No Items List.</h1>
                            </div><?php
                        }
                        ?>
                    </div>
                    <form action="../process/data_process.php" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="min-height: 250px" class="modal-body" >
                                        <input  name="updatePostTitle" class="updatePostTitle">
                                        <textarea name="updatePostDataSection" class="updatePostDataSection" style="resize: none; width: 100%;height: 240px"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="user_no_from" class="user_no_from">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="btn-save-changes" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

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
        $(".editPost").click(function () {
            var value = $(this).attr('data-id');
            var postDataCollect = " ";
            $.ajax({
                type: "POST",
                url: "../process/data_process.php",
                data: {
                    value: value,
                    postDataCollect :postDataCollect
                },
                success: function(data)
                {
                    var data = JSON.parse(data);

                    $(".updatePostDataSection").val(data.post)
                    $(".updatePostTitle").val(data.title)
                    $(".user_no_from").val(data.no)

                }
            });
        })
    });
</script>
</body>
</html>



