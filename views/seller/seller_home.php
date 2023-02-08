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
                        <a href="seller_home.php" class="nav-link active">
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


        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row my-5 ">

                    <?php
                    $lists = $datamanipulation->showAllGiftData();
                    if($lists){
                        foreach ($lists as $list){
                            $user = $datamanipulation->showBuyerDataById($list->user_id)
                            ?>
                            <div class="col-md-3 mr-5 rounded"  style="height: 100px ;background-image: linear-gradient(#ff7e60 ,#556270 )">
                                <div class="mt-2">
                                    <p class="text-white text-center align-items-center text-uppercase"><?php echo $list->position?> Winner</p>
                                    <h5 class="text-white text-center align-items-center"><?php echo $user->name?></h5>
                                </div>

                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>

            <?php
            $lists =$datamanipulation->showAllPost();
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
                                    <div class="">
                                        <strong>Post By: <?php echo $list->name?></strong>
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
<script>
    showData()
    var user_name = $("#name").val();
    var user_id = $("#user_id").val();
    var position = $("#position").val();
    function tConvert (time) {
        // Check correct time format and split into components
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

        if (time.length > 1) { // If time format correct
            time = time.slice (1);  // Remove full string match value
            time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join (''); // return adjusted time or original string
    }
    function showData() {
        var getData = " ";
        $.ajax({
            type: "GET",
            url: "../process/data_process.php",
            data: {
                getData: getData
            },
            success: function(data)
            {
                var data = JSON.parse(data);
                var html = " ";
                var htmlString = " ";
                for (var i = 0;  i<data.length;  i++){
                    if (data[i].commentNo == null) {
                        html +="<div class=\"\">\n" +
                            "<div class=\"card card-widget\">\n" +
                            "<div class=\"card-header\">\n" +
                            "<div class=\"user-block\">\n" +

                            "<span class=\"username\"><a href=\"#\">" + data[i].name + "</a></span>\n" +
                            "<span class=\"description\">" +data[i].date + " Time " +  tConvert(data[i].time) +"</span>\n" +
                            "</div>\n" +
                            "<div class=\"card-tools\">\n"
                        if(data[i].user_id != user_id && data[i].position != 'Buyers' && data[i].position != 'Sellers' ) {
                            html+= "<button data-id ='"+ data[i].user_id +"' type=\"button\" class=\"btn confirm_Btn_eye\"  data-toggle=\"modal\" data-target=\"#exampleModal\">\n" +
                                "<i class=\"fas fa-eye\"></i>\n" +
                                "</button>\n"
                        }
                        html +="<button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"collapse\">\n" +
                            "<i class=\"fas fa-minus\"></i>\n" +
                            "</button>\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "<div class=\"card-body\">\n" +
                            "<div style='white-space: pre-wrap; font-weight: bold; font-size: 30px'>" + data[i].title + "</div>" +
                            "<div style='white-space: pre-wrap;'>" + data[i].post + "</div>" +
                            "<video class=\"img-fluid pad\"  controls>"+
                            "<source src='"+ data[i].image +"' type=\"video/mp4\"><source src='"+ data[i].image +"' type=\"video/ogg\">"+
                            "</video>"+
                            "<p><span class=\"float-right text-muted\">Comments</span></p></div>"

                        for (var j = 0; j < data.length; j++) {
                            if (data[i].no == data[j].commentNo) {
                                html += "<div class=\"card-footer card-comments\">\n" +
                                    "<div class=\"card-comment\">\n" +

                                    "<div class=\"comment-text\">\n" +
                                    "<span class=\"username\">\n" + data[j].name +
                                    "<span class=\"text-muted float-right\">" + tConvert(data[j].time) + "</span>\n" +
                                    "</span>" + data[j].post +
                                    "</div>\n" +
                                    "</div>\n" +
                                    "</div>\n"
                            }
                        }
                        html += "<div class=\"card-footer\">\n" +
                            "<a href='' data-id ='"+ data[i].no +"' class=\"telegrambtn text-primary img-fluid img-circle img-sm\"><i class=\"fab fa-telegram fa-2x\" ></i></a>\n" +
                            "<div class=\"img-push\">\n" +
                            "<input type=\"text\" class=\"form-control form-control-sm\" placeholder=\"Press enter to post comment\">\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "</div>"


                    }
                    $(".dataShow").html(html);
                    $(".telegrambtn").click(function (e) {
                        e.preventDefault();
                        var commentValue = $(this).parent().find('input').val();
                        var commentNo = $(this).attr("data-id");
                        var user_name = $("#name").val();
                        var user_id = $("#user_id").val();
                        if (commentValue.length>0){
                            $.ajax({
                                type: "POST",
                                url: "../process/data_process.php",
                                data: {
                                    commentValue: commentValue,
                                    commentNo: commentNo,
                                    user_name: user_name,
                                    user_id: user_id,
                                },
                                success: function(data)
                                {
                                    showData()
                                }
                            });
                            $(this).parent().find('input').val(" ")

                        }
                    })
                    $(".confirm_Btn_eye").click(function () {
                        var confirm = $(this).attr('data-id');
                        $(".parent_id").val(confirm)
                    });
                }


            }
        });
    }
    function submitPostData(form_data) {
        $.ajax({
            type: "POST",
            url: "../process/data_process.php",
            data: form_data,
            processData:false,
            contentType:false,
            cache:false,
            success: function(data)
            {
                console.log(data)
                showData()
            }
        });
    }
    $(".btnConfirmSend").click(function (e) {
        e.preventDefault();
        var ConfirmForm = new FormData($('#ConfirmForm')[0]);
        $.ajax({
            type: "POST",
            url: "../process/data_process.php",
            data: ConfirmForm,
            processData:false,
            contentType:false,
            cache:false,
            success: function(data)
            {
                document.getElementById("ConfirmForm").reset();
                window.location.href = "confirm_product.php";
            }
        });
    });
    $(".resetbtn").click(function () {
        document.getElementById("ConfirmForm").reset();
    });
    $(".newNotice").click(function (e) {
        e.preventDefault();
        var textarea = $(".post-message").val().length;
        var post_title = $("#post_title").val().length;
        var textareas = $(".post-message").val();
        var imageFilename = $("#customFile").val().length;
        var form_data = new FormData($('#FormData')[0]);
        /*form_data.append("file",imageFilename);*/
        form_data.append("user_name",user_name);
        form_data.append("user_id",user_id);
        form_data.append("position",position);
        /* form_data.append("textarea",textareas);*/
        if(textarea>0 && imageFilename>0 && post_title>0)
        {

            submitPostData(form_data);
            $(".post-message").val("");
            $("#post_title").val("");
            $("#customFile").val('');
            $(".custom-file-label").text('Choose File');
        }

    })

</script>

</body>
</html>



