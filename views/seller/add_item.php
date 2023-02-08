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
<div class="wrapper" xmlns="http://www.w3.org/1999/html">
    <?php
    include_once 'seller_nav.php';
    ?>

    <aside style="background-color: rgba(116,12,41,0.6)" class="student-bg main-sidebar sidebar-dark-primary elevation-4">


        <div class="sidebar" style="position: fixed">

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
                        <a href="add_item.php" class="nav-link active">
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


        <!-- Main content -->
        <section class="content">

            <?php

            if(isset($_SESSION['uploadImage'])){

                echo $_SESSION['uploadImage'];
                unset($_SESSION['uploadImage']);

            }   if(isset($_SESSION['errorId'])){

                echo $_SESSION['errorId'];
                unset($_SESSION['errorId']);

            }
            ?>

            <div class="container-fluid mt-5">
                <div class="row">
                    <form action="../process/seller_process.php" method="post" enctype="multipart/form-data">


                    <div  class="w-100 card card-primary card-outline ">
                        <div class="card-header">
                            <h2>Add Item</h2>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-4">
                                    <label>
                                        Product Id:
                                    </label>
                                    <input type="text" name="product_id" class="form-control"/>
                                    <input type="hidden" name="seller_id" value="<?php echo $user_id?>" class="form-control"/>
                                </div>
                                <div class="col-4 mb-2">
                                    <label>
                                        Product Name:
                                    </label>
                                    <input type="text" name="name" class="form-control"/>
                                </div>
                                <div class="col-4 mb-2">
                                    <label>
                                        Product Price:
                                    </label>
                                    <input type="text" name="price" class="form-control"/>
                                </div>


                                <div class="col-4 mb-2">
                                    <label>
                                        Product Image:
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" name="photo" class="custom-file-input"  id="customFile" accept="image/*">
                                        <label class="custom-file-label" for="customFile">Choose File</label>
                                    </div>
                                </div>
                                <div class="col-4 mb-2">
                                    <label>
                                        Product Category :
                                    </label>
                                    <select class="w-100 py-2" name="category">
                                        <?php
                                        $lists=$datamanipulation->showCategory();
                                        foreach ($lists as $list){
                                            ?>
                                            <option value="<?php echo $list->category?>"><?php echo $list->category?></option>
                                            <?php

                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>
                                        Product Description :
                                    </label>
                                    <textarea type="text" name="description" class="form-control" cols="3" rows="5"></textarea>
                                </div>
                                <button class="col-6 btn btn-success mt-2 rounded" name="add_item" style="background-image: linear-gradient(#556270, #ff6b6b)"> Add </button>
                            </div>
                        </div>

                    </div>
                    <!-- /.col -->


                    <!-- /.card -->

                    <!-- /.col -->
                </div>
                </form>
                <?php

                if(isset($_SESSION['TostUpdate'])){

                    echo $_SESSION['TostUpdate'];
                    unset($_SESSION['TostUpdate']);

                }    if(isset($_SESSION['DeleteMSG'])){

                    echo $_SESSION['DeleteMSG'];
                    unset($_SESSION['DeleteMSG']);

                }
                ?>
                <div class="row col-12">


                    <?php
                    $allProducts = $datamanipulation->AllMyProduct($user_id);
                    if($allProducts){
                        foreach ($allProducts as $allProduct){

                                ?>
                                <input name="item_id" type="hidden" value="<?php echo $allProduct->item_id?>">
                                <input name="name" type="hidden" value="<?php echo $allProduct->product_name?>">
                                <input name="price" type="hidden" value="<?php echo $allProduct->price?>">
                                <input name="seller_id" type="hidden" value="<?php echo $allProduct->seller_id?>">
                                <input name="buyer_id" type="hidden" value="<?php echo $user_id?>">
                                <div class="card col-md-4">
                                    <div class="card-body">
                                        <img class="w-100" height="300" src="<?php echo $allProduct->image?>"/>
                                    </div>
                                    <div class="card-footer">
                                        <span>Name: <?php echo $allProduct->product_name?></span><br>
                                        <span>Price: <?php echo $allProduct->price?></span><br>
                                        <span style="color: #1fc8e3;font-size: 18px"><?php echo $allProduct->description?></span>
                                        <div class="row">
                                            <div class=" col-6">
                                                <a data-id="<?php echo $allProduct->item_id?>" class="btn btn-success form-control editPost" name="add_card" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i> Edit</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="../process/seller_process.php?delete_item_id=<?php echo $allProduct->item_id?>" class="btn btn-primary form-control" name="add_card"><i class="fas fa-trash"></i> Delete</a>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <?php

                                ?>



                        <?php }}?>
                    <form action="../process/data_process.php" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Iteam</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div style="min-height: 60px" class="modal-body" >
                                        <label>Name:</label>
                                        <input  name="updateProductName" class="updateProductName" style=" width: 320px">
                                        <br>
                                        <label>Price:</label>
                                        <input name="updatePrice" class="updatePrice">
                                        <br>
                                        <label>Description:</label>
                                        <br>
                                        <textarea name="updateDescription" class="updateDescription" cols="55" rows="8"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="item_id" class="item_id">
                                        <button type="submit" name="btn-save-changes" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.row -->
                </div>
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



