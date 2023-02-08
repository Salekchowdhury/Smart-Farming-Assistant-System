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

            <div class="container-fluid mt-5 student-bg">
                <div class="row student-bg">
                    <form action="../process/seller_process.php" method="post">


                    <div  class="w-100 h-100  card card-primary card-outline ">
                        <div class="card-header">
                            <h2>Order Details</h2>
                        </div>
                        <div class="card-body">
                          <?php
                          if(isset($_GET['cart_id'])){
                              $itemData=$datamanipulation->showItemByCardId($_GET['cart_id']);
                              $itemImage=$datamanipulation->showItemImage($itemData->item_id);
                          }
                          ?>
                            <div class="row">
                                <div class="col-6">
                                    <label>
                                         Name:
                                    </label>
                                    <input type="text" name="product_id" disabled value="<?php echo $itemData->name?>" class="form-control"/>
                                    <input type="hidden" name="cart_id"  value="<?php echo $itemData->cart_id?>"/>

                                </div>
                                <div class="col-6 mb-2">
                                    <label>
                                        Number:
                                    </label>
                                    <input type="text" name="name" disabled value="<?php echo $itemData->phone?>" class="form-control"/>
                                </div>
                                <div class="col-6">
                                    <label>
                                        Quantity:
                                    </label>
                                    <input type="text" name="price" disabled value="<?php echo $itemData->quantity?>" class="form-control"/>
                                </div>
                                  <?php
                                  if($itemData->transaction_id){
                                    ?>
                                      <div class="col-6">
                                          <label>
                                              Payment Method:
                                          </label>
                                          <input type="text" name="price" disabled value="Bkash" class="form-control"/>
                                      </div>
                                       <div class="col-6">
                                          <label>
                                              Transaction Id:
                                          </label>
                                          <input type="text" name="price" disabled value="<?php echo $itemData->transaction_id?>" class="form-control"/>
                                      </div>

                                      <?php
                                  }else{
                                      ?>
                                      <div class="col-6">
                                          <label>
                                              Payment Method:
                                          </label>
                                          <input type="text" name="" disabled value="Cash On Delivey" class="form-control"/>
                                      </div>


                                      <?php
                                  }
                                  ?>


                                     <div class="col-6">
                                        <label>
                                            Price:
                                        </label>
                                         <?php
                                         if($itemData->uprice){
                                             ?>
                                             <input type="text" name="price" disabled value="<?php echo $itemData->uprice?>" class="form-control"/>
                                             <?php
                                         }else{
                                            ?>
                                             <input type="text" name="price" disabled value="<?php echo $itemData->price?>" class="form-control"/>
                                             <?php
                                         }
                                         ?>

                                    </div>
                                    <div class="col-6">
                                        <label>
                                            Delivery Date:
                                        </label>
                                        <input type="date" required name="deliveryDate" value="" class="form-control">
                                    </div>


                                <div class="col-6">

                                    <div class="custom-file">
                                        <br>
                                       <img src="<?php echo $itemImage->image?>" height="130" width="130" style="border-radius: 50%">
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                        <button class="col-12 btn btn-success mt-2" name="confirm_order"> Confirm Order</button>
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



