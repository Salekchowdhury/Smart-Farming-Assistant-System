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
$data=$datamanipulation->showAdminDataById($user_id);
$phone=$data->phone;

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
                if($data->image){
                    ?>
                    <img  src="<?php echo $data->image?>" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }else{
                    ?>
                    <img  src="../../contents/img/f4.png" class="img-circle elevation-2"  alt="User Image">
                    <?php
                }
                ?>

                <div class="info">
                    <a href="profile.php" class="d-block"><?php echo $data->name?>(Admin)</a>
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
                        <a href="message.php" class="nav-link active">
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
                                    <thead class=" text-primary" style="background-image: linear-gradient(#9b95fb, #bbff0a);">
                                    <th style="color: black">
                                        SL
                                    </th>
                                    <th style="color: black">
                                        Name
                                    </th>
                                    <th style="color: black">
                                        Position
                                    </th>
                                    <th style="text-align: center;color: black">
                                        Action
                                    </th>
                                    </thead>
                                    <tbody class="attrTable" style="background-image: linear-gradient(#590c70, #bfa512)">
                                    <?php
                                    $bookingData =$datamanipulation->viewAllUse();
                                    $s=1;
                                    if($bookingData){
                                        foreach ($bookingData as $list){
                                            ?>
                                            <tr>
                                                <td class="text-light">
                                                    <?php echo $s?>
                                                </td>
                                                <td  class="attrName" style="color: white">
                                                    <?php echo $list->name?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>
                                                <td  class="attrName; text-light">
                                                    <?php echo $list->position?>
                                                    <span class="message-show-on-alert badge-danger badge"></span>
                                                </td>
                                                <td class="text-center text-light">
                                                    <a data-id="<?php echo $list->user_id?>" style="background-image: linear-gradient(#9b95fb, #bbff0a);" class="btn text-dark attrValue show-chat-box-click" ><i class="fab fa-telegram-plane"></i> Chat</a>

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

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../contents/js/adminlte.min.js"></script>

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
//                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
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
//                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
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



