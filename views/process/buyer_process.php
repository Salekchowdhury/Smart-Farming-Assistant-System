<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 9/3/2020
 * Time: 2:52 PM
 */
include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");

use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$authenticate =new authentication();
if(!isset($_SESSION)){
    session_start();

}

/*$name=$data->name;
$image=$data->image;
$profession=$data->profession;
$phone=$data->phone;
$holding_no=$data->holding_no;
$bio=$data->bio;
$owner_name= $ownerData->owner_name;
$building_name= $ownerData->building_name;
$road_no= $ownerData->road_no;
$bio= $ownerData->bio;*/

if(isset($_GET['logout'])){
    session_destroy();
    Utility::redirect("../../views/login_register_forgot/login.php");
    //include_once ("../../views/login_register_forgot/login.php");
}
if(isset($_POST['buyerProfileChange'])) {
    $user_id=$_POST['user_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $shop_name=$_POST['shop_name'];
    $address=$_POST['address'];
//var_dump($_POST['chanage_profile']);
    $data=$datamanipulation->UpdateBuyerprofile($name,$email,$phone,$shop_name,$address,$user_id);
    $status = $datamanipulation->updateNotice($id, $notice);
    if ($status) {
        Utility::redirect("../../views/seller/notice.php");
    }
}
if(isset($_GET['delete_notice'])){

    $status = $datamanipulation->deleteNotice($_GET['delete_notice']);
    if($status){
        Utility::redirect("../../views/seller/notice.php");

    }

}

if(isset($_GET['confirm_user_by_building_woner'])){
    $action='yes';
    $status = $datamanipulation->confirm_user_by_building_woner($_GET['confirm_user_by_building_woner'],$action);
    if($status){
        Utility::redirect("../../views/seller/pending_request.php");


    }

}
if(isset($_GET['confirm_user_by_building_woner_from_member_list'])){
    $action='yes';
    $status = $datamanipulation->confirm_user_by_building_woner($_GET['confirm_user_by_building_woner_from_member_list'],$action);
    if($status){
        Utility::redirect("../../views/seller/membership_subscription.php");


    }

}

if(isset($_POST['update'] )){
    $http= $_SERVER['HTTP_REFERER'];
    $update = $datamanipulation->updateUserData($_POST['user_id'],$_POST['name'],$_POST['profession'],$_POST['phone'],$_POST['road_no'],$_POST['holding_no'],$_POST['owner_name'],$_POST['building_name'],$_POST['address'],$_POST['bio']);
    //var_dump($update);
    if($update){
        $_SESSION["UdateMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Updated - </b> Update Your Data Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }
}

    if (isset($_POST['buyerImageUpload'])) {
        $http_reffer= $_SERVER['HTTP_REFERER'];
        $id = $_POST['id'];
        var_dump($id);
        $random= rand(1000,9999);
        $files = $_FILES['photo'];
        $fileName = $files['name'];
        $fileTmpName = $files['tmp_name'];
        $image = '../../contents/img/' .$random. $fileName;

        move_uploaded_file($fileTmpName, $image);



        $status = $datamanipulation->updateSellerPhoto($image,$id);

        if($status){
            $_SESSION["uploadImage"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Change - </b> Change Photo Successfully....</span>
                         </div>";

            Utility::redirect( "$http_reffer");
        }

    }


if (isset($_POST['checkedNo'])){
        $checkedNo = $datamanipulation->updateChatActiveNo($_POST['user_id']);
        return $checkedNo;
}
if (isset($_POST['checkedYes'])){
    $checkedYes = $datamanipulation->updateChatActiveYes($_POST['user_id']);
}

if(isset($_POST['changePass'] )){
    $http= $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $new_password = $_POST['new_password'];
    var_dump($_POST['changePass'] );
    $data = $datamanipulation->changeBuyerPassword($id,$new_password);

    if($data){
        $_SESSION["UpdatePass"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Updated - </b> Update Your Password Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }
}
if(isset($_POST['add_card'] )){
    $http= $_SERVER['HTTP_REFERER'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $item_id = $_POST['item_id'];
    $seller_id = $_POST['seller_id'];
    $buyer_id = $_POST['buyer_id'];
    $phone = $_POST['phone'];
    $data = $datamanipulation->insertCartProduct($price,$name,$item_id,$seller_id,$buyer_id,$phone);
    Utility::redirect("$http");
}
if(isset($_POST['coutnRating'] )){
    //var_dump($_POST);
    $user_id = $_POST['user_id'];
    $client_id = $_POST['client_id'];
    $deleteRating = $datamanipulation->deleteRating($user_id,$client_id);
    $coutnRating = $_POST['coutnRating'];
//    $coutnRating = $_POST['coutnRating'];
    $total_rating = $datamanipulation->showRatingById($user_id);

    if($total_rating){
        $total = $total_rating->total_rating + $coutnRating;
        $data = $datamanipulation->insertRate($user_id,$client_id,$coutnRating,$total);
    }else{
        $total = 0;
        $data = $datamanipulation->insertRate($user_id,$client_id,$coutnRating,$total);
    }

    $http_reffer = $_SERVER['HTTP_REFERER'];

    Utility::redirect("$http_reffer");
}
if (isset($_POST['updateQuantity'])){
    $http= $_SERVER['HTTP_REFERER'];
    $updateQuantity = $_POST['updateQuantity'];
    $totalPrice = $_POST['totalPrice'];
    $cart_id = $_POST['cart_id'];
    $totalQuantity = $_POST['totalQuantity'];
    $totalQuantity = ($totalQuantity+$updateQuantity);
    $totalPrice = ($totalQuantity*$totalPrice);
    $datamanipulation->updateQuantity($cart_id,$totalQuantity,$totalPrice);
    //var_dump($totalQuantity);
    Utility::redirect("$http");
}
if (isset($_GET['cancelQuantity'])){
    $http= $_SERVER['HTTP_REFERER'];
    $datamanipulation->deletecard($_GET['cancelQuantity']);
    Utility::redirect("$http");
}
if (isset($_POST['btnConfirmSend'])){
    $http= $_SERVER['HTTP_REFERER'];

    $datamanipulation->cartUpdateConfirm($_POST['buyer_id'],$_POST['seller_id'],$_POST['transactionId']);
    Utility::redirect("$http");
}

