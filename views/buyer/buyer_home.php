
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
$profileData=$datamanipulation->showBuyerDataById($user_id);
$phone=$profileData->phone;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <!--<link rel="stylesheet" href="../../contents/css/new.css">-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php
    include_once 'buyer_nav.php';
    ?>

    <aside style="background-image: linear-gradient(#5d3570, #bfa94d)" class=" main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light"><b>Smart Farming(Consumer)</b></span>
        </a>

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
                    <a href="profile.php" class="d-block"><?php echo $profileData->name?></a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="profile.php" class="nav-link ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="farmers.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Farmers
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="manage_order.php" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Manage Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_notice.php" class="nav-link ">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>Admin Notice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="message.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Message</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="contact_us.php" class="nav-link">
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

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <input type="hidden" id="name" name="name" value="<?php echo $profileData->name?>">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id?>">
                <input type="hidden" id="position" name="position" value="<?php echo $profileData->position?>">
                <div class="row col-md-12 d-flex justify-content-center ">
                <div class="col-md-8 dataShow"></div>

                </div>
            </div>
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
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
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
                            "<div class=\"card-tools\">\n";

                        html+="<button data-id ='"+ data[i].no +"' type=\"button\" class=\"btn btn-tool\"  data-card-widget=\"collapse\">\n" +
                            "<i class=\"fas fa-minus\"></i>\n" +
                            "</button>\n" +
                            "</div>\n" +
                            "</div>\n" +
                            "<div class=\"card-body\">\n" +
                            "<div style='white-space: pre-wrap; font-weight: bold; font-size: 30px'>" + data[i].title + "</div>" +
                            "<div style='white-space: pre-wrap;'>" + data[i].post + "</div>" +
                            "<video class=\"img-fluid pad d-block mx-auto\"  controls>"+
                            "<source src='"+ data[i].image +"' type=\"video/mp4\"><source src='"+ data[i].image +"' type=\"video/ogg\">"+
                            "</video>"+
                            "<p><span class=\"float-right text-muted\">Comments</span></p></div>"

                        for (var j = 0; j < data.length; j++) {
                            if (data[i].no == data[j].commentNo) {
                                html += "<div class=\"card-footer card-comments\">\n" +
                                    "<div class=\"card-comment\">\n" +
                                    "<div class=\"comment-text\">\n" +
                                    "<span class=\"username\">\n" + data[j].name +
                                    "<span class=\"text-muted float-right\">"  + tConvert(data[j].time) + " </span>\n" +
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
//                    $(".confirm_Btn_eye").click(function () {
//                        var confirm = $(this).attr('data-id');
//                        var parents_ids = ($(this).parent().find('button').eq("1").attr('data-id'))
//                        $(".parent_id").val(confirm)
//                        $(".parents_ids").val(parents_ids);
//
//                        console.log(confirm)
//                        var fake_data = " "
//                        $.ajax({
//                            type: "POST",
//                            url: "../process/data_process.php",
//                            data: {
//                                parents_ids: confirm,
//                                fake_data:fake_data
//                            },
//                            success: function(data)
//                            {
//                                var data = JSON.parse(data)
//                                console.log(data.pnumber)
//                                $(".show-number-bkash").text(data.pnumber);
//                            }
//                        });
//                    });
                }
            }
        });

    }
//    function submitPostData(form_data) {
//        $.ajax({
//            type: "POST",
//            url: "../process/data_process.php",
//            data: form_data,
//            processData:false,
//            contentType:false,
//            cache:false,
//            success: function(data)
//            {
//                showData()
//            }
//        });
//    }
//    $(".btnConfirmSend").click(function (e) {
//        e.preventDefault();
//        var ConfirmForm = new FormData($('#ConfirmForm')[0]);
//        $.ajax({
//            type: "POST",
//            url: "../process/data_process.php",
//            data: ConfirmForm,
//            processData:false,
//            contentType:false,
//            cache:false,
//            success: function(data)
//            {
//                document.getElementById("ConfirmForm").reset();
//                window.location.href = "confirm_product.php";
//            }
//        });
//    });
//    $(".resetbtn").click(function () {
//        document.getElementById("ConfirmForm").reset();
//    });
//    $(".newNotice").click(function (e) {
//        e.preventDefault();
//        var textarea = $(".post-message").val().length;
//        var post_title = $("#post_title").val().length;
//        var textareas = $(".post-message").val();
//        var imageFilename = $("#customFile").val().length;
//        var form_data = new FormData($('#FormData')[0]);
//        /*form_data.append("file",imageFilename);*/
//        form_data.append("user_name",user_name);
//        form_data.append("user_id",user_id);
//        form_data.append("position",position);
//        /* form_data.append("textarea",textareas);*/
//        if(textarea>0 && imageFilename>0 && post_title>0)
//        {
//
//            submitPostData(form_data);
//            $(".post-message").val("");
//            $("#post_title").val("");
//            $("#customFile").val('');
//            $(".custom-file-label").text('Choose File');
//        }
//    })

</script>
</body>
</html>



