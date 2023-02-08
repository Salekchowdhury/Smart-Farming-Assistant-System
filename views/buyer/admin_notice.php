
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
    <title>Notice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../contents/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../contents/css/adminlte.min.css">
    <link rel="stylesheet" href="../../contents/css/custom.css">
    <link rel="stylesheet" href="../../contents/css/new.css">
    <link rel="stylesheet" href="../../contents/css/custom-bg-farmer.css">
    <link rel="stylesheet" href="../../contents/css/custom-style.css">

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
                    <a href="profile.php" class="d-block"><?php echo $name?></a>
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
                        <a href="admin_notice.php" class="nav-link active">
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="callout callout-info" style="background-image: linear-gradient(#5d3570, #bfa94d)" >
                            <h3 class="card-title text-center" style="color: white">Notice Section</h3>
                            <div class="row">
                                <div class="col-md-4">

                                </div>
                            </div>
                            <br/>
                            <?php
                            $notices =$datamanipulation->showAllNotice();
                            foreach ($notices as $notice ){
                                $note=$notice->notice;

                                $date=$notice->date;
                                $dateArray = explode("-",$date);

                                $dateRevers= array_reverse($dateArray);
                                $dateString = implode("-", $dateRevers);
                                ?>
                                <div class="row">
                                    <!-- <div class="col-8"><b><?php /*$date = $lists->date; echo  date(' m/d/Y', strtotime($date)); $time = $lists->time; echo"   ". date('h:i:s a' , strtotime($time));*/?></b></div>
-->
                                    <div class=""> </div>
                                    <div class="col-12 text-light text-right"> <?php echo $dateString?> (<span style="color: white; font-size: 18px"><?php echo "   ". date('h:i:s a' , strtotime($notice->time))?></span>)</div>


                                </div>
                                <strong class="text-light pb-4" style="text-align: justify;margin-bottom: 50px;">
                                    <?php echo $notice->title?>
                                </strong>
                                <p class="text-light mt-2" style="text-align: justify;margin-bottom: 50px; border-bottom: 2px solid #0b2e13">
                                    <?php echo $note?>
                                </p>
                                <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>

<script src="../../contents/plugins/jquery/jquery.min.js"></script>

<script src="../../contents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../../contents/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../../contents/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../contents/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../contents/js/adminlte.min.js"></script>

<script src="../../contents/js/demo.js"></script>
<script>
    $(function () {
        $("#sohag1").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag2").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $("#sohag3").DataTable({
            "lengthMenu":[ 3,4 ],
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        $('#sohag').DataTable({
            "paging": true,
            "lengthMenu":[ 3 ],
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function () {
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })
      $('.checkedNo').click(function(){
          var user_id = $(".user-id").val();
          console.log(user_id);
          var checkedNo = "";
          $.ajax({
              type: "POST",
              data: {checkedNo: checkedNo,user_id:user_id},
              url: "../process/building_owner_process.php",
              success: function (data) {
                  location.reload(true)
              }
          });
      });
      $('.checkedYes').click(function(){
          var user_id = $(".user-id").val();
          console.log(user_id);
          var checkedYes = "";
          $.ajax({
              type: "POST",
              data: {checkedYes: checkedYes,user_id:user_id},
              url: "../process/building_owner_process.php",
              success: function () {
                  location.reload(true)
              }
          });
      });

    bsCustomFileInput.init();
      setInterval(function () {
          var ary = [];
          $(function () {
              $('.attrTable tr').each(function (a, b) {
                  /*var name = $('.attrName', b).text();*/
                  var value = $('.attrValue', b).attr('data-id');
                  ary.push(value)

              });
              console.log(JSON.stringify(ary));


              var user_id = $(".user-id").val();
              $.ajax({
                  url: "../process/user_process.php",
                  type:'GET',
                  data:{user_type:ary,user_id:user_id},
                  success:function (result) {
                      console.log(result)
                      var datas = JSON.parse(result),
                          htmlstring = "";
                      var j = 0;
                      for (var f = 0; f<ary.length; f++) {
                          for (var i = 0; i < datas.length; i++) {

                              if ((datas[i].user_id == ary[f]) && (datas[i].message_read == 'unseen')  ) {
                                  $('.attrTable tr').each(function (a, b) {
                                      var name = $('.attrName', b).text();
                                      if($(".attrValue",b).attr('data-id')== datas[i].user_id){
                                          j=j+1;
                                          htmlstring = $(".attrValue",b).attr('data-id');

                                          $('.attrName .message-show-on-alert',b).text(j);
                                      }
                                  });

                              }
                              else if ((datas[i].opponent_id == ary[f]) && (datas[i].message == 'unseen') ) {
                                  $('.attrTable tr').each(function (a, b) {
                                      var name = $('.attrName', b).text();
                                      /!*var value = $('.attrValue', b).attr('data-id');*!/
                                      if($(".attrValue",b).attr('data-id')== datas[i].opponent_id){
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
      },1000);

      $('#chatmessages').scrollTop($('#chatmessages')[0].scrollHeight);

          $(".change-button-show").click(function () {
              var opponent_id = $(this).attr("data-id");
              var user_id = $(".user-id").val();
              setInterval(function () {
                  showMessageData(user_id,opponent_id)

                  $('.close-btn').click(function () {
                      opponent_id = null;
                  });
              },1000)


              /*setInterval(function () {
                  $.ajax(
                      {
                          url: "../process/student_data_process.php",
                          type: "POST",
                          data: {id: messageseid,mail:messagesmail},
                          success: function (response) {
                              var data = JSON.parse(response),
                                  htmlstring = "";
                              for(var i=0; i<data.length; i++){

                                  if((data[i].message_from)!=null){
                                      htmlstring +='<div class="chat student"> ' +
                                          '<div class="user-photo"> ' +
                                          '<img src="../../contents/img/profile_image/tuTorImoji.png" alt="User Image"> ' +
                                          '</div> ' +
                                          "<p class='chat-message teacher-msg'>"+data[i].message_from+"</p> " +
                                          '</div>';
                                  }
                                  if((data[i].message_to)!=null){
                                      htmlstring += '<div class="chat self">' +
                                          '<div class="user-photo"> ' +
                                          '<img src="../../contents/img/profile_image/stImoji.jpg" alt="User Image"> ' +
                                          '</div> ' +
                                          '<p class="chat-message student-msg">'+data[i].message_to+'</p> ' +
                                          '</div>';
                                  }
                                  $('.chatlogs').html(htmlstring);
                              }
                          }
                      });
                  $('.close-btn').click(function () {
                      messagesmail=null;
                  });
              },1000);*/

              $(".text-value-get").text(opponent_id);
              $(".chatbox").show();
//            $(".user-email-from-teacher-details").val(messagesid);

          });

          $('.close-btn').click(function () {
              var self = $(this);
              console.log('close');
              self.next().html('');
             location.reload(true)
          });

          $(".change-hidden").click(function () {
              $(".chatbox").css("display","none");
              $(".change-button-show").prop('disabled',false);
          });
          $("#send").click(function (event) {
              event.preventDefault();
              var messages = $("#message-value").val().trim();
              if(messages.length){
                  var user_id = $(".user-id").val()
                  var opponent_id = $(".text-value-get").text();

                  $.ajax({
                      type: "POST",
                      data: {messages: messages,user_id:user_id,opponent_id:opponent_id},
                      url: "../process/user_process.php",
                      success: function () {
                          messages="";
                          $("#message-value").val(messages)

                          showMessageData(user_id,opponent_id);

                      }
                  });
              }


          });


          function showMessageData(user_id,opponent_id) {
              $.ajax(
                  {

                      url: "../process/user_process.php",
                      type: "POST",
                      data: {user_id: user_id,opponent_id:opponent_id},
                      success: function (response) {

                          var data = JSON.parse(response),
                              htmlstring = "";
                          for(var i=0; i<data.length; i++){

                              if((data[i].message_from)!=null){
                                  htmlstring +='<div class="chat student"> ' +
                                      '<div class="user-photo"> ' +
                                      '<img src="../../contents/img/smart-city.jpg" alt="User Image"> ' +
                                      '</div> ' +
                                      "<p class='chat-message teacher-msg'>"+data[i].message_from+"</p> " +
                                      '</div>';
                              }
                              if((data[i].message_to)!=null){
                                  htmlstring += '<div class="chat self">' +
                                      '<div class="user-photo"> ' +
                                      '<img src="../../contents/img/smart-city.jpg" alt="User Image"> ' +
                                      '</div> ' +
                                      '<p class="chat-message student-msg">'+data[i].message_to+'</p> ' +
                                      '</div>';
                              }

                              $('.chatlogs').html(htmlstring);
                          }
                      }
                  });
          }





  });


</script>
</body>
</html>



