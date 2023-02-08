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
$_SESSION['checkBack']=1;
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
                        <a href="expert.php" class="nav-link active">
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
        <section class="content-header">
            <div>
                <input type="hidden" class="user_id" value="<?php echo $user_id?>">
                <input type="hidden" class="user_name" value="<?php echo $name?>">
                <input type="hidden" class="buyers_name">
                <input type="hidden"  class="buyers_id">
            </div>

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h3>Expert List</h3>


                        <table id="sohag1" class="table table-bordered table-hover">
                            <thead>
                            <tr style="color: white;background-color: rgba(116,12,41,0.6);position:;">
                                <th>Serial</th>
                                <th>Client Name</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="tableBody attrTable">
                            <?php
                            $list = $datamanipulation->viewExpertInfo();
                            $count = 1;
                            if ($list){
                                foreach ($list as $lists){
                                    ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td class="attrName"><?php echo $lists->name ?>
                                            <span class="message-show-on-alert badge-danger badge"></span>
                                        </td>
                                        <td><?php echo $lists->phone ?></td>
                                        <td><?php echo $lists->email ?></td>

                                        <td>
                                            <a data-id = "<?php echo $lists->user_id?>" href="#" class="attrValue show-chat-box-click btn btn-info btn-sm"><i class="fab fa-telegram-plane"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div style="display: none; position: absolute; width: 30%; bottom: 0;right: 5%; z-index: 9999999" class="show-chat-box card card-warning direct-chat direct-chat-warning shadow">
                <div class="card-header">
                    <div class="card-tools btn-close-tool-active">
                        <button type="button" class="btn btn-tool btn-close-tool">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" >
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
        </section>



        <footer>

        </footer>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#">Rafia</a>.</strong>
        All rights reserved.

    </footer>
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
        var sellers_id = $(".user_id").val();
        $(function () {
            $('.attrTable tr').each(function (a, b) {
                /*var name = $('.attrName', b).text();*/
                var value = $('.attrValue', b).attr('data-id');
                ary.push(value)
            });
            /*//console.log(JSON.stringify(ary));*/
            $.ajax({
                url: "../process/chat_process.php",
                type:'GET',
                data:{user_type:ary,sellers_id:sellers_id},
                success:function (result) {
                    var datas = JSON.parse(result);
                    //console.log(result);
                    htmlstring = "";
                    var j = 0;
                    for (var f = 0; f<ary.length; f++) {
                        for (var i = 0; i < datas.length; i++) {
                            if ((datas[i].message == "unseen") && (datas[i].buyers_id == ary[f]) ) {
                                //console.log(datas)

                                $('.attrTable tr').each(function (a, b) {
                                    var name = $('.attrName', b).text();
                                    /*var value = $('.attrValue', b).attr('data-id');*/
                                    if($(".attrValue",b).attr('data-id') == datas[i].buyers_id){
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
        var sellers_name = $(".user_name").val();
        var sellers_id = $(".user_id").val();
        var buyers_id = $(this).attr("data-id");
        var sellerDataCollectViaId = "";
        var buyers_name = $(this).parent().parent().find('td').eq('1').text().trim();
        $(".buyers_id").val(buyers_id);
        $(".buyers_name").val(buyers_name);
        //alert(buyers_name)
        setInterval(function () {
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    sellerSDataCollectViaId :sellerDataCollectViaId,
                    buyers_id :buyers_id,
                    sellers_id :sellers_id,
                },
                success: function(data)
                {
                    //console.log(data);
                    var data = JSON.parse(data);
                    htmlstring = "";
                    for(var i =0; i<data.length;i++){

                        if((data[i].message_to) !=null){
                            htmlstring += "<div class=\"direct-chat-msg \">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                "                            <span class=\"direct-chat-name float-left\">"+ data[i].sellers_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-right\">"+tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
//                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                        if((data[i].message_from) !=null){
                            htmlstring +="<div class=\"direct-chat-msg right\">\n" +
                                "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                "                            <span class=\"direct-chat-name float-right\">" + data[i].buyers_name + "</span>\n" +
                                "                            <span class=\"direct-chat-timestamp float-left\">" + tConvert(data[i].time) + "</span>\n" +
                                "                        </div>\n" +
//                                "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
                                "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
                                "                        </div>\n" +
                                "                    </div>"
                        }
                        $('.chatlogs').html(htmlstring);
                    }


                }
            });
        },1000);
        $(".btn-close-tool-active").click(function () {
            buyers_id = null
            location.reload();
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
        /*location.reload();*/
    });

    $(".chatSendBtn").click(function () {
        var sellers_name = $(".user_name").val();
        var sellers_id = $(".user_id").val();
        var buyers_id = $(".buyers_id").val();
        var buyers_name = $(".buyers_name").val();
        var chat_message = $(".chatMessageSend").val();
        var htmlstring = " ";
        var sellerDataCollectViaId = " ";
        if(chat_message.length>0){
            $.ajax({
                type: "POST",
                url: "../process/chat_process.php",
                data: {
                    buyers_names :buyers_name,
                    buyers_ids :buyers_id,
                    sellers_ids :sellers_id,
                    sellers_names :sellers_name,
                    chat_messages :chat_message,
                    sellerActive :htmlstring
                },
                success: function(data)
                {
                    $(".chatMessageSend").val("")
                    $.ajax({
                        type: "POST",
                        url: "../process/chat_process.php",
                        data: {
                            sellerSDataCollectViaId :sellerDataCollectViaId,
                            buyers_id :buyers_id,
                            sellers_id :sellers_id,
                        },
                        success: function(data)
                        {
                            var data = JSON.parse(data);
                            for(var i =0; i<data.length;i++){
                                if((data[i].message_to) !=null){
                                    htmlstring += "<div class=\"direct-chat-msg \">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                        "                            <span class=\"direct-chat-name float-left\">"+ data[i].sellers_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-right\">"+tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
//                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn2.iconfinder.com/data/icons/bots-monochrome/280/5-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_to +
                                        "                        </div>\n" +
                                        "                    </div>"
                                }
                                if((data[i].message_from) !=null){
                                    htmlstring +="<div class=\"direct-chat-msg right\">\n" +
                                        "                        <div class=\"direct-chat-infos clearfix\">\n" +
//                                        "                            <span class=\"direct-chat-name float-right\">" + data[i].buyers_name + "</span>\n" +
                                        "                            <span class=\"direct-chat-timestamp float-left\">" + tConvert(data[i].time) + "</span>\n" +
                                        "                        </div>\n" +
//                                        "                        <img class=\"direct-chat-img\"  src=\"https://cdn3.iconfinder.com/data/icons/chat-bot-blue-filled-color/300/215226424Untitled-3-512.png\"  alt=\"Message User Image\">\n" +
                                        "                        <div class=\"direct-chat-text\">\n" + data[i].message_from +
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


