<?php
include_once ("../vendor/autoload.php");

use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
    if(isset($_GET['find'])){

        $data = $datamanipulation->Search($_GET['find']);
        var_dump($data);
    }


?>




<form class="form" action="index.php" method="get">
    <input type="text" class="length-min" name="find" placeholder="Search what you want to find">

    <input type="button" name="Search"  class="Search" value="Search">

</form>
<div style="display: none; color: red; " class="error"></div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        $(".search").click(function () {
            var lenght = $(".length-min").val()
            if(lenght.length<4){
                $(".error").css("display","block")
                $(".error").text("please search a valid query")
            }
            else {
                $(".error").css("display","none")
                $(".form").submit();

            }
        })
    })
</script>