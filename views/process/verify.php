<?php


include_once ("../../vendor/autoload.php");
use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();

if(!isset($_SESSION)){
    session_start();
}
$email=$_SESSION['email'];

 //$registration=new registration();
 if(isset($_POST['confirm'])){
     $status=$registration->verify($_POST['code']);
     if($status){
         utility::redirect("../../views/login_register_forgot/login.php");
         //include_once ("");
     }else{

         $http_referer=$_SERVER['HTTP_REFERER'];
         $_SESSION['errorMesseage']="<div class='alert alert-danger'>Wrong Code, Try again..</div>";
         utility::redirect($http_referer);
     }
 }

if(isset($_POST['confirmForgotPassword'])){

    $http_referer=$_SERVER['HTTP_REFERER'];
    $pass= $_POST['password'];
    $otp=$_POST['otp'];
    $email=$_POST['email'];
//    var_dump($_POST);
    $verifyUserToken=$datamanipulation->updateUserToken($otp,$pass);
    $verifyAdminToken=$datamanipulation->verifyAdminToken($otp,$pass);
    //var_dump($verifyUserToken);
    //var_dump($verifyAdminToken);
   //var_dump($_POST);
    if($verifyUserToken ){
        var_dump($verifyUserToken);
        utility::redirect("../../views/login_register_forgot/login.php");
        include_once ("../../views/login_register_forgot/login.php");
    }else if ($verifyAdminToken){
        utility::redirect("../../views/login_register_forgot/login.php");

    }else {
        $_SESSION['errorMesseage']="<div class='alert alert-danger'>Wrong Code, Try again..</div>";
        utility::redirect($http_referer);
    }
}
