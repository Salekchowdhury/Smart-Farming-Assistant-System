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
                        <a href="add_category.php" class="nav-link active">
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


        <!-- Main content -->
        <section class="content">

            <?php

            if(isset($_SESSION['addCategory'])){
                echo $_SESSION['addCategory'];
                unset($_SESSION['addCategory']);
                unset($_GET['edit_category_id']);
            }

            if(isset($_SESSION['errorCategory'])){
                echo $_SESSION['errorCategory'];
                unset($_SESSION['errorCategory']);
                unset($_GET['edit_category_id']);

            } if(isset($_SESSION['UpdateCategory'])){
                echo $_SESSION['UpdateCategory'];
                unset($_SESSION['UpdateCategory']);
                unset($_GET['edit_category_id']);
            }

            ?>

            <div class="container-fluid mt-5">
                <div class="row mt-4">
                    <div class="col-md-6 mt-5">
                        <?php

                        if(isset($_GET['edit_category_id'])){
                            $data = $datamanipulation->showCategoryByCategoryId($_GET['edit_category_id']);
                            $category = $data->category;
//                            var_dump($category);

                          ?>
                            <form action="../process/seller_process.php" method="post">

                                <div  class="w-100 card card-primary card-outline mt-4">
                                    <div class="card-header">

                                        <h2>Edit Category</h2>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="id" value="<?php echo $data->id?>" class="form-control"/>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label>
                                                    Category Name:
                                                </label>
                                                <input type="text" name="category" value="<?php echo $data->category?>" class="form-control"/>
                                            </div>

                                            <button class="col-12 btn btn-success mt-2" name="edit_category" style="background-image: linear-gradient(#0c0970, #4cbf15)"> Edit Category</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <?php

                        }else{
                            ?>
                            <form action="../process/seller_process.php" method="post">


                                <div  class="w-100 card card-primary card-outline mt-4">
                                    <div class="card-header">
                                        <h2>Add Category</h2>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12">
                                                <input type="hidden" name="user_id" value="<?php echo $user_id?>" class="form-control"/>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label>
                                                    Category Name:
                                                </label>
                                                <input type="text" name="category" class="form-control"/>
                                            </div>

                                            <button class="col-12 btn btn-success mt-2" name="add_category" style="background-image: linear-gradient(#0c0970, #4cbf15)"> Add Category</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="col-12 mt-5">
                            <div class="card">

                                <div class="card-body">
                                    <h3>Category List</h3>
                                    <?php

                                    if(isset($_SESSION['DeleteCategory'])){
                                        echo $_SESSION['DeleteCategory'];
                                        unset($_SESSION['DeleteCategory']);
                                    }
                                    if(isset($_SESSION['confirmMSG'])){
                                        echo $_SESSION['confirmMSG'];
                                        unset($_SESSION['confirmMSG']);
                                    }
                                    ?>

                                    <table id="sohag1" class="table table-bordered table-hover">
                                        <thead>
                                        <tr style="color: white;background-image: linear-gradient(#0c0970, #4cbf15);position:;">
                                            <th>Serial</th>
                                            <th>Category Name</th>
                                            <th>Date</th>
                                            <th style="text-align: center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
//                                        $lists=$datamanipulation->showMyOrderHistoryById($user_id);
                                        $lists=$datamanipulation->showCategory();
                                        $s=1;
                                        foreach ($lists as $list){
                                            ?>
                                            <tr>
                                                <td><?php echo $s?></td>
                                                <td><?php echo $list->category?></td>
                                                <td><?php echo $list->date?></td>
                                                 <td>
                                                     <a style="color: white"  href="../process/seller_process.php?category_id=<?php echo $list->id?>" <i class="  btn btn-danger btn-outline-success " aria-hidden="true"></i> DELETE</a>
                                                     <a style="color: white"  href="add_category.php?edit_category_id=<?php echo $list->id?>" <i class="  btn btn-success btn-outline-primary " aria-hidden="true"></i> EDIT</a>

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
                    </div>

                </div>

                <?php

                if(isset($_SESSION['TostUpdate'])){

                    echo $_SESSION['TostUpdate'];
                    unset($_SESSION['TostUpdate']);

                }    if(isset($_SESSION['DeleteMSG'])){

                    echo $_SESSION['DeleteMSG'];
                    unset($_SESSION['DeleteMSG']);

                }
                ?>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script>


    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });


</script>
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

                    $(".updateProductName").val(data.product_name)
                    $(".updatePrice").val(data.price)
                    $(".updateDescription").val(data.description)
                    $(".item_id").val(data.item_id)

                }
            });
        })
    });
</script>

</body>
</html>



