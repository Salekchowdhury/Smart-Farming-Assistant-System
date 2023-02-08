<?php

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
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
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
if(isset($_POST['chanage_profile'])){
    $user_id=$_POST['user_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $shop_name=$_POST['shop_name'];
    $address=$_POST['address'];
    $data=$datamanipulation->UpdateSellerData($name,$email,$phone,$shop_name,$address,$user_id);
    $updateName=$datamanipulation->UpdatePostName($name,$user_id);


    $http= $_SERVER['HTTP_REFERER'];
    if($data){
        $_SESSION["UdateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Success - </b> Update Data Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }

}
if(isset($_POST['buyerProfileChange'])){
    $user_id=$_POST['user_id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $data=$datamanipulation->UpdateBuyerData($name,$email,$phone,$address,$user_id);


    $http= $_SERVER['HTTP_REFERER'];
    if($data){
        $_SESSION["UdateMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Success - </b> Update Data Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }

}

if(isset($_POST['sellerChangePassword'])){
    $user_id=$_POST['user_id'];
    $new_password=$_POST['new_password'];

    $data=$datamanipulation->updateSellerPass($new_password,$user_id);


    $http= $_SERVER['HTTP_REFERER'];
    if($data){
        $_SESSION["UpdatePass"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Success - </b> Update Password Successfully. </span>
                        </div>";
        Utility::redirect("$http");
    }

}
if(isset($_POST['ChangePhoto'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $type = $_POST['type'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $shop_name=$_POST['shop_name'];
    $address=$_POST['address'];
    $password=$_POST['password'];
    $new_password=$_POST['new_password'];

    if($new_password){
        $new_password = $new_password;
    }else{
        $new_password = $password;
    }


    var_dump($_POST['ChangePhoto']);
    $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);

        if($type == 'admin'){
            if(!empty($fileName)){
                $status = $datamanipulation->updateAdminProfileWithImage($name,$email,$phone,$address,$new_password,$image,$id);

            }else{
                $status = $datamanipulation->updateAdminProfileWithOutImage($name,$email,$phone,$address,$new_password,$id);
            }
        }else{
            if(!empty($fileName)){
                $status = $datamanipulation->updateSellerProfileWithImage($name,$email,$phone,$shop_name,$address,$new_password,$image,$id);

            }else{
                $status = $datamanipulation->updateSellerProfileWithOutImage($name,$email,$phone,$shop_name,$address,$new_password,$id);
            }
        }



    if($status){
        $_SESSION["uploadImage"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Change - </b> Profile Successfully....</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }



}
if(isset($_POST['adminProfileChange'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $new_password=$_POST['password'];

//    var_dump($_POST['ChangePhoto']);
    $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);


    if(!empty($fileName)){
        $status = $datamanipulation->updateSellerProfileWithImage($name,$email,$phone,$address,$new_password,$image,$id);

    }else{
        $status = $datamanipulation->updateSellerProfileWithOutImage($name,$email,$phone,$address,$new_password,$id);
    }


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
if(isset($_POST['add_item'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];

    $product_id = $_POST['product_id'];
    $seller_id = $_POST['seller_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    //var_dump($id);
    $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);



    $checkItem = $datamanipulation->checkItem($product_id,$seller_id);
    if(!$checkItem){
        $status = $datamanipulation->insertItem($product_id,$seller_id,$name,$price,$category,$image,$description);

        if($status){
            $_SESSION["uploadImage"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Item Added Successfully....</span>
                         </div>";

            Utility::redirect( "$http_reffer");
        }
    }else{
        $_SESSION["errorId"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Sorry! - </b> Product id $product_id is already exists  </span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }




}

if(isset($_POST['add_category'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_id'];
    $category = $_POST['category'];

    $checkCategory = $datamanipulation->checkCategory($user_id,$category);
    if(!$checkCategory){

        $status = $datamanipulation->addCategory($user_id,$category);
        if($status){
            $_SESSION["addCategory"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Category Successfully....</span>
                         </div>";

            Utility::redirect( "$http_reffer");
        }
    }else{
        $_SESSION["errorCategory"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Sorry! - </b>Category  $category is already exists  </span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }




}

if(isset($_POST['shopImage'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    var_dump($id);
    $random= rand(1000,9999);
    $files = $_FILES['photo'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);



    $status = $datamanipulation->updateShopPhoto($image,$id);

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
if(isset($_POST['confirm_order'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_POST['cart_id'];
    $date=$_POST['deliveryDate'];



    $status = $datamanipulation->confirmOrder($id,$date);
    //var_dump($status);
    //var_dump($_POST);

    if($status){
        $_SESSION["confirmMSG"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Confirmed - </b> Order Confirm Successfully....</span>
                         </div>";

        Utility::redirect( '../seller/order_history.php');
        //include '../seller/order_history.php';
    }



}
if(isset($_GET['delete_item_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_GET['delete_item_id'];
    $status = $datamanipulation->deleteItemId($id);

    if($status){
        $_SESSION["DeleteMSG"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Deleted - </b> Delete Item Successfully....</span>
                         </div>";
        Utility::redirect( "$http_reffer");
    }

}
if(isset($_GET['category_id'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_GET['category_id'];
    $status = $datamanipulation->deleteCategoryById($id);

    if($status){
        $_SESSION["DeleteCategory"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Deleted - </b> Category Successfully....</span>
                         </div>";
        Utility::redirect( "$http_reffer");
    }

}
if(isset($_POST['edit_category'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $id = $_POST['id'];
    $category = $_POST['category'];
    $status = $datamanipulation->UpdateCategoryById($id,$category);

    if($status){
        $_SESSION["UpdateCategory"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Updated - </b> Category Successfully....</span>
                         </div>";
        Utility::redirect( "$http_reffer");
    }

}








