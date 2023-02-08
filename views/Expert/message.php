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
    <title>Message</title>
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
    include_once 'expert_nav.php';
    ?>

    <aside style="background-color: rgba(12,73,38,0.78); background-image: linear-gradient(#556270, #ff6b6b)" class=" main-sidebar sidebar-dark-primary elevation-4">


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
                        <a href="add_post.php" class="nav-link ">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>
                                Post
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="message.php" class="nav-link active">
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

    <div class="content-wrapper" style="background-image: linear-gradient(#ff6b6b ,#556270 )">
        <input type="hidden" class="user_id" value="<?php echo $user_id?>">
        <input type="hidden" class="user_name" value="<?php echo $name?>">
        <input type="hidden" class="sellers_name">
        <input type="hidden"  class="seller_id">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chat</h1>
                    </div>
                </div>
            </div>
        </section>


        <div class="content wow rotateInDownLeft" data-wow-duration= "1s">
            <div class="row">
                <div class="col-md-12" >
                    <div class="card card-plain">

                        <div class="card-body">
                            <div class="scroll-content">
                                <table class="table">
                                    <thead class=" text-primary" style="background-image: linear-gradient(#ff6b6b ,#556270 )">
                                    <th style="color: white">
                                        SL
                                    </th>
                                    <th style="color: white">
                                        Name
                                    </th>
                                    <th style="color: white">
                                        Position
                                    </th>
                                    <th style="color: white">
                                        Phone
                                    </th>
                                    

                                    <th style="text-align: center;color: white">
                                        Action
                                    </th>
                                    </thead>
                                    <tbody class="attrTable">
                                    <?php
//                                    $bookingData =$datamanipulation->viewSellerInfo();
//                                    $bookingData =$datamanipulation->viewOwnerInfo();
                                    $bookingData =$datamanipulation->viewSellerInfo();
                                    $s=1;
                                    if($bookingData){
                                        foreach ($bookingData as $list){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $s?>
                                                </td>
                                                <td  class="attrName">
                                                    <?php echo $list->name?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>
                                                <td>
                                                    <?php echo $list->position?>

                                                </td>

                                                <td>
                                                    <?php echo $list->phone?>

                                                </td>
                                                <td class="text-center">
                                                    <a data-id="<?php echo $list->user_id?>" class="btn bg-success btn-outline-success attrValue show-chat-box-click" ><i class="fab fa-telegram-plane"></i> Chat</a>

                                                </td>
                                            </tr>
                                            <?php
                                            $s++;
                                        }
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none; position: absolute; width: 30%; bottom: 0;right: 5%; z-index: 9999999" class="show-chat-box card card-warning direct-chat direct-chat-warning shadow">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-close-tool">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body ">
                <div style="height: 400px" class="direct-chat-messages chatlogs">


                </div>
            </div>
            <div class="card-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control chatMessageSend">
                        <span class="input-group-append">
                      <button type="button" class="btn btn-warning chatSendBtn">Send</button>
                    </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>

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
    setInterval(function () {
        var ary = [];
        var buyers_id = $(".user_id").val();
        $(function () {
            $('.attrTable tr').each(function (a, b) {
                /*var name = $('.attrName', b).text();*/
                var value = $('.attrValue', b).attr('data-id');
                ary.push(value)
            });
            /*console.log(JSON.stringify(ary));*/
            $.ajax({
                url: "../process/chat_process.php",
                type:'GET',
                data:{user_type_for_buyers:ary,user_id:buyers_id},
                success:function (result) {
                    var datas = JSON.parse(result);
                    htmlstring = "";
                    var j = 0;
                    for (var f = 0; f<ary.length; f++) {
                        for (var i = 0; i < datas.length; i++) {
                            if ((datas[i].messageRead == "unseen") && (datas[i].sellers_id == ary[f]) ) {
                                console.log(datas)
                                $('.attrTable tr').each(function (a, b) {
                                    var name = $('.attrName', b).text();
                                    /*var value = $('.attrValue', b).attr('data-id');*/
                                    if($(".attrValue",b).attr('data-id') == datas[i].sellers_id){
                                        j=j+1;
                                        htmlstring = $(".attrValue",b).attr('data-id');
                                        $('.attrName .message-show-on-alert',b).text(j);
                                    }
                                });
                            }
                        }
                        j=0;
                    }
                }
            });
        });
    },800);
    $(".show-chat-box-click").click(function () {
        var buyers_name = $(".user_name").val();
        var buyers_id = $(".user_id").val();
        var sellers_id = $(this).attr("data-id");
        var sellerDataCollectViaId = "";
        var sellers_name = $(this).parent().parent().find('td').eq('1').text().trim();
        $(".seller_id").val(sellers_id);
        $(".sellers_name").val(sellers_name);

        setInterval(function () {
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    sellerDataCollectViaId :sellerDataCollectViaId,
                    buyers_id :buyers_id,
                    sellers_id :sellers_id,
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    var htmlstring = "";
                    for(var i =0; i<data.length;i++){
                        if((data[i].message_from) !=null){
                            htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                "                            <span class=\"direct-chat-name float-left\">" + data[i].sellers_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                        if((data[i].message_to) !=null){
                            htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                "                            <span class=\"direct-chat-name float-right\">"+ data[i].buyers_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                    }
                    $('.chatlogs').html(htmlstring);
                }
            });
        },1000);

        $(".btn-tool").click(function () {
            sellers_id = null;
            $(".seller_id").val("")
        });
        $(".show-chat-box").css("display","block")

    });
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

    $(".btn-close-tool").click(function () {
        $(".show-chat-box").css("display","none");
        location.reload();
    });

    $(".chatSendBtn").click(function () {
        var buyers_name = $(".user_name").val();
        var buyers_id = $(".user_id").val();
        var sellers_id = $(".seller_id").val();
        var sellers_name = $(".sellers_name").val();
        var chat_message = $(".chatMessageSend").val();
        var htmlstring = " ";
        var sellerDataCollectViaId = " ";
        if(chat_message.length>0){
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    buyers_name :buyers_name,
                    buyers_id :buyers_id,
                    sellers_id :sellers_id,
                    sellers_name :sellers_name,
                    chat_message :chat_message,
                },
                success: function(data)
                {
                    $(".chatMessageSend").val("")
                    $.ajax({
                        type: "POST",
                        url: "../process/chat_process.php",
                        data: {
                            sellerDataCollectViaId :sellerDataCollectViaId,
                            buyers_id :buyers_id,
                            sellers_id :sellers_id,
                        },
                        success: function(data)
                        {
                            var data = JSON.parse(data);
                            for(var i =0; i<data.length;i++){
                                if(data[i].message_from !=null){
                                    htmlstring +="<div class=\"direct-chat-msg\">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                        "                            <span class=\"direct-chat-name float-left\">" + data[i].sellers_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-right\">" + tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
//                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                        "                        </div>\n" +
                                        "                    </div>"
                                }
                                if(data[i].message_to !=null){
                                    htmlstring += "<div class=\"direct-chat-msg right\">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                        "                            <span class=\"direct-chat-name float-right\">"+ data[i].buyers_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-left\">"+tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
//                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                        "                        </div>\n" +
                                        "                    </div>"
                                }
                            }
                            $('.chatlogs').html(htmlstring);
                        }
                    });
                }
            });
        }
    });

</script>
</body>
</html>



