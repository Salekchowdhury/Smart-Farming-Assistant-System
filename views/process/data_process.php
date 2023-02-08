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
$mail = new PHPMailer( true);

$authenticate =new authentication();
//$registration =new registration();
if(!isset($_SESSION)){
    session_start();
}


//if(isset($_POST['login'])){
//var_dump($_POST);
//    $email=$_POST['email'];
//    $password=$_POST['password'];
//    $CheckAdminEmail = $authenticate->checkAdminEmail($email,$password);
//    $CheckUserEmail = $authenticate->checkUserEmail($email,$password);
//
//    if($CheckAdminEmail){
//        $_SESSION['user_id']=$CheckAdminEmail->admin_id;
//        $_SESSION['email']=$CheckAdminEmail->email;
//        $_SESSION['name']=$CheckAdminEmail->name;
//        utility::redirect("../../views/Admin/profile.php");
//
//    }else if ($CheckUserEmail){
//
//        $Seller='Seller';
//        $Buyer='Buyer';
//
//
//
//        $type="$CheckUserEmail->position";
//
//
//        if($type==$Seller){
//            $_SESSION['user_id']=$CheckUserEmail->user_id;
//            $_SESSION['email']=$CheckUserEmail->email;
//            $_SESSION['name']=$CheckUserEmail->name;
//            utility::redirect("../../views/seller/profile.php");
//
//        }
//        elseif ($type==$Buyer){
//            $_SESSION['user_id']=$CheckUserEmail->user_id;
//            $_SESSION['email']=$CheckUserEmail->email;
//            $_SESSION['name']=$CheckUserEmail->name;
//            utility::redirect("../buyer/profile.php");
//
//        }
//
//
//    }else{
//        $http_reffer= $_SERVER['HTTP_REFERER'];
//        $_SESSION["errorMessageForLogin"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
//                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
//                             <i class=\"nc-icon nc-simple-remove\"></i>
//                           </button>
//                           <span>
//                             <b> Sorry! - </b> Wrong  email or Password.. Please Try Agin!.</span>
//                         </div>";
//        Utility::redirect("$http_reffer");
//    }
//
//
//
//
//
//
// }

if(isset($_POST['login'])){
    var_dump($_POST);
    $email=$_POST['email'];
    $password=$_POST['password'];

    $Seller='Seller';
    $Buyer='Buyer';
    $Expert='Expert';

    $admin= 0;
    $CheckAdminEmail = $authenticate->checkAdminEmail($email,$password);
    if($CheckAdminEmail){
        $admin = 1;
    }
    $CheckUserEmail = $authenticate->checkUserEmail($email,$password);
    $type="$CheckUserEmail->position";
    $checkActive = $authenticate->checkActive($email,$password);
    if($checkActive){
        if ($CheckUserEmail && $type==$Seller){

            $payment = $authenticate->checkPaymentById($CheckUserEmail->user_id);
            if($payment){
                $paymentData = $authenticate->checkPaymentSatatus($payment->date, date("Y-m-d"));
                if($paymentData->day<=30){
//                var_dump($payment->status);
//                var_dump($payment);
                    if($type==$Seller && $payment->status =='yes' ){

                        $_SESSION['user_id']=$CheckUserEmail->user_id;
                        $_SESSION['email']=$CheckUserEmail->email;
                        $_SESSION['name']=$CheckUserEmail->name;
                        utility::redirect("../../views/seller/profile.php");

                    }else{
                        $http_reffer= $_SERVER['HTTP_REFERER'];
                        $_SESSION["paymentApprovalMsg"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Payment - </b>  not yet approved. Please Try after sometime</span>
                         </div>";
                        Utility::redirect("$http_reffer");
                    }
                }else{
                    $_SESSION['user_id']=$CheckUserEmail->user_id;
                    $_SESSION['email']=$CheckUserEmail->email;
                    $_SESSION['name']=$CheckUserEmail->name;
                    utility::redirect("../../views/payment/payment.php");
                }

                var_dump($paymentData);
            }else{
                $_SESSION['user_id']=$CheckUserEmail->user_id;
                $_SESSION['email']=$CheckUserEmail->email;
                $_SESSION['name']=$CheckUserEmail->name;
                utility::redirect("../../views/payment/payment.php");

            }

        }else if($type==$Buyer){
            $_SESSION['user_id']=$CheckUserEmail->user_id;
            $_SESSION['email']=$CheckUserEmail->email;
            $_SESSION['name']=$CheckUserEmail->name;
            utility::redirect("../buyer/profile.php");
        }else if($type==$Expert){
            $_SESSION['user_id']=$CheckUserEmail->user_id;
            $_SESSION['email']=$CheckUserEmail->email;
            $_SESSION['name']=$CheckUserEmail->name;
            utility::redirect("../Expert/profile.php");
        }
        else{
            $http_reffer= $_SERVER['HTTP_REFERER'];
            $_SESSION["errorMessageForLogin"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Sorry! - </b> Wrong  email or Password.. Please Try Agin!.</span>
                         </div>";
            Utility::redirect("$http_reffer");
        }

    }else if($CheckAdminEmail){

        $_SESSION['user_id']=$CheckAdminEmail->admin_id;
        $_SESSION['email']=$CheckAdminEmail->email;
        $_SESSION['name']=$CheckAdminEmail->name;
        utility::redirect("../../views/Admin/profile.php");

    }else{

        $http_reffer= $_SERVER['HTTP_REFERER'];
        $_SESSION["errorMessageForLogin"] = "<div class=\"alert alert-danger alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Sorry! - </b> Your Account Not Verified!.</span>
                         </div>";
        Utility::redirect("$http_reffer");
    }

}




 if(isset($_POST['signup'])){
     $http_reffer= $_SERVER['HTTP_REFERER'];
     $name=$_POST['name'];
     $email=$_POST['email'];
     $position=$_POST['position'];
     $password=$_POST['password'];
     $emailToken = rand(100000, 999999);
     $_POST['emailToken'] = $emailToken;


     $files = $_FILES['photo'];
     $fileName = $files['name'];
     $fileTmpName = $files['tmp_name'];
     $destinationFile = '../../contents/img/' . $emailToken . $fileName;
     move_uploaded_file($fileTmpName, $destinationFile);
     $_POST['destinationFile']=$destinationFile ;
     $image = $_POST['destinationFile'];

     $isExistAdmin=$datamanipulation->checkEmailInAdminTable($email);
     $isExistUsers=$datamanipulation->checkEmailInUserTable($email);
 if ($isExistUsers || $isExistAdmin){
     $_SESSION["isExistMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Warning - </b> Email already exist. Please give another email. </span>
                        </div>";
     Utility::redirect("$http_reffer");
 }else{
     try {
         //Server settings
         $mail->SMTPDebug = 0;                                       // Enable verbose debug output
         $mail->isSMTP();                                            // Set mailer to use SMTP
         $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'smartfarmingassistantsystem@gmail.com';                     // SMTP username
         $mail->Password   = 'cgebungsuvkabheo';                               // SMTP password
         $mail->SMTPSecure = 'ssl';         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
         $mail->Port       = 465;                                    // TCP port to connect to

         //Recipients
         $mail->setFrom('smartfarmingassistantsystem@gmail.com', 'smart farming assistant system');
         $mail->addAddress("$email", 'User');     // Add a recipient
         $mail->addAddress('ellen@example.com');               // Name is optional
         $mail->addReplyTo('smartfarmingassistantsystem@gmail.com', 'confirmation code');
         // $mail->addCC('cc@example.com');
         // $mail->addBCC('bcc@example.com');

         // Attachments
         //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

         // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = 'Confirmation Code';
         $mail->Body    = "$emailToken";
         $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

         if($mail->send()){
             $insert = $datamanipulation->insertUserData($name,$email,$position,$password,$image,$emailToken);
             $_SESSION['email']=$email;
             $_SESSION['name']=$name;
             if ($insert){

                 Utility::redirect("../login_register_forgot/verification.php");


             }


         }

     }
     catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         //echo 'Message has been sent';
     }
 }


 }

if (isset($_POST['edit_post'])) {
    $http_reffer= $_SERVER['HTTP_REFERER'];

    $title = $_POST['title'];
    $id = $_POST['id'];

    $post = $_POST['post'];

    $random= rand(1000,9999);

    $files = $_FILES['image'];
    var_dump($files["size"]);
    if(!empty($files["size"])){
        $fileName = $files['name'];
        $fileTmpName = $files['tmp_name'];
        $image = '../../contents/img/' .$random. $fileName;
        move_uploaded_file($fileTmpName, $image);

        $status = $datamanipulation->editPostWithImage($id,$title,$post,$image);

        if($status){
            $_SESSION["add_post"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Post Successfully....</span>
                         </div>";

            Utility::redirect( "$http_reffer");
        }
    }else{
        $status = $datamanipulation->editPostWithOutImage($id,$title,$post);

        if($status){
            $_SESSION["add_post"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Post Successfully....</span>
                         </div>";

            Utility::redirect( "$http_reffer");
        }
    }






}

if (isset($_POST['add_post'])) {
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $user_id = $_POST['user_id'];
    $post = $_POST['post'];

    $random= rand(1000,9999);
    $files = $_FILES['image'];
    $fileName = $files['name'];
    $fileTmpName = $files['tmp_name'];
    $image = '../../contents/img/' .$random. $fileName;

    move_uploaded_file($fileTmpName, $image);



    $status = $datamanipulation->addPost($user_id, $title,$name,$post,$image);

    if($status){
        $_SESSION["add_post"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                           <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <i class=\"nc-icon nc-simple-remove\"></i>
                           </button>
                           <span>
                             <b> Added - </b> Post Successfully....</span>
                         </div>";

        Utility::redirect( "$http_reffer");
    }

}

if(isset($_POST['payment_send'])){
    $http_reffer= $_SERVER['HTTP_REFERER'];
    $name=$_POST['name'];
    $amount=$_POST['amount'];
    $phone=$_POST['phone'];
    $transaction_id=$_POST['transaction_id'];
    $date=$_POST['date'];
    $user_id=$_POST['user_id'];

    $paymnetStatus =$datamanipulation->addPayment($user_id,$name,$amount,$phone,$transaction_id,$date);
    if($paymnetStatus){

        $_SESSION["paymentMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Sended - </b> Your Payment Successfully. </span>
                        </div>";

        Utility::redirect("../login_register_forgot/login.php");

    }else{
        $_SESSION["WronMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Sorry - </b> Your confirmation code is wrong. </span>
                        </div>";
        Utility::redirect("$http_reffer");
    }


}

 if(isset($_POST['confirm'])){
     $http_reffer= $_SERVER['HTTP_REFERER'];
    $email=$_POST['email'];
    $code=$_POST['code'];
    $checkCode =$datamanipulation->checkConfirmCode($email,$code);
    if($checkCode){
        $checkCode =$datamanipulation->updateToken($email,$code);
        Utility::redirect("../login_register_forgot/login.php");
       // include_once '../login_register_forgot/login.php'
    }else{
        $_SESSION["WronMsg"] = "<div class=\"alert alert-warning alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Sorry - </b> Your confirmation code is wrong. </span>
                        </div>";
        Utility::redirect("$http_reffer");
    }


 }
 if(isset($_GET['delete_post_id'])){
     $http_reffer= $_SERVER['HTTP_REFERER'];

    $status =$datamanipulation->deletePost($_GET['delete_post_id']);
    if($status){
        $_SESSION["deleteMsg"] = "<div class=\"alert alert-success alert-dismissible fade show\">
                          <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <i class=\"fa fa-times\"></i>
                          </button>
                          <span>
                            <b> Deleted - </b> Post Successfully. </span>
                        </div>";
        Utility::redirect("$http_reffer");
    }


 }
 if (isset($_GET['getData']))
{
    $data = $datamanipulation->getPostDataToShow();
    echo json_encode($data);
}
 if (isset($_GET['dataNo']))
{
    $data = $datamanipulation->getPostDataToShowdataNo($_GET['dataNo']);
    echo json_encode($data);
}
if (isset($_POST['noticeInfo'])){
    $files = rand(1000,10000).$_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $destinationFile ='../../assets/img/'.$files;
    move_uploaded_file($fileTmpName,$destinationFile);
    $_POST['destinationFile']=$destinationFile ;
    $user_name = $_POST['user_name'];
    //$position = $_POST['position'];
    $user_id = $_POST['user_id'];
    $textarea = $_POST['noticeInfo'];
    $image = $_POST['destinationFile'];
    $post_title = $_POST['post_title'];
    $datamanipulation->textareaPostSave($user_id,$user_name,$textarea,$image,$post_title);
    print_r($_FILES['file']);
}
if (isset($_POST['commentValue'])){
    $commentNo = $_POST['commentNo'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $commentValue = $_POST['commentValue'];
    $approved = 'yes';
    $data = $datamanipulation->insertComment($user_id,$user_name,$commentValue,$commentNo,$approved);

}

if (isset($_POST['postDataCollect'])){

    $user_id = $_POST['value'];
    $data = $datamanipulation->postDataCollectviaUserId($user_id);
    echo json_encode($data);
}

if (isset($_POST['btn-save-changes'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $item_id = $_POST['item_id'];
    $updateProductName = $_POST['updateProductName'];
    $updatePrice = $_POST['updatePrice'];
    $updateDescription = $_POST['updateDescription'];
    $data = $datamanipulation->updateItem($item_id,$updateProductName,$updatePrice,$updateDescription);
    if ($data){
        $_SESSION['TostUpdate'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"polite\" style=\"\"><div class=\"toast-message\">Update item Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_GET['managePostDelete'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['managePostDelete'];
    $managePostDelete = $datamanipulation->managePostDelete($id);
    if ($managePostDelete){
        $_SESSION['TostUpdate'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['item_need'])){
    $user_id = $_POST['user_id'];
    $parent_id = $_POST['parent_id'];
    $confirm_name = $_POST['confirm_name'];
    $address = $_POST['address'];
    $item_need = $_POST['item_need'];
    $pnumber = $_POST['pnumber'];
    $parents_ids = $_POST['parents_ids'];
    $unitsofproduct = $_POST['unitsofproduct'];
    $transactionId = $_POST['transactionId'];
    $datamanipulation->confirmProductInformation($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct,$transactionId);
}


if (isset($_GET['seller_user_id'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id =$_GET['seller_user_id'];
    $data = $datamanipulation->orderDelete($user_id);
    Utility::redirect("$http_reffer");
    
}
