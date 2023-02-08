<?php

namespace App\DataManipulation;
use App\Model\Database as DB;
use  App\Utility\Utility;



class DataManipulation extends DB
{

 public function checkEmailInAdminTable($email){

    $sql = "SELECT * FROM admin where email = '".$email."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
    public function insertComment($user_id,$name,$post,$commentNo,$approved){
        $dataArray=array($user_id,$name,$post,$commentNo,$approved);
        $sql="insert into post(user_id,name,post,date,time,commentNo,approved)VALUES (?,?,?,now(),now(),?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
    public function textareaPostSave($user_id,$name,$post,$image,$post_title){
        $dataArray=array($user_id,$name,$post,$image,$post_title);
        $sql="insert into post(user_id,name,post,image,title,date,time)VALUES (?,?,?,?,?,now(),now())";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
public function getPostDataToShow(){
    $sql = "SELECT * FROM post ORDER BY no DESC ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function viewPostComment($postNo){
    $sql = "SELECT * FROM post where commentNo = '".$postNo."' ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function showAllPost(){
    $sql = "SELECT * FROM post ORDER BY no DESC";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function viewAllUse(){
    $sql = "SELECT * FROM users";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function postDataCollectviaUserId($id){
    $sql = "SELECT * FROM item WHERE item_id ='".$id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
public function checkCategory($id, $category){
    $sql = "SELECT * FROM category WHERE user_id ='".$id."' && category='".$category."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();

    return $satatus;
}
public function viewConfimrListInfo($id){
    $sql = "SELECT * FROM card where buyer_id = '".$id."' && status='yes' ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function postUpdateDataCollectviaUserId($user_id,$title,$post){
    $dataArray=array($title,$post);
    $sql="update  post set title=?, post=? WHERE no ='".$user_id."'";
    $data= $this->Dbconnect->prepare($sql);
    $status=$data->execute($dataArray);
    return $status;
}
public function getPostDataToShowdataNo($user_id){
    $sql = "SELECT * FROM post WHERE commentNo = '".$user_id."' ORDER BY no DESC ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function managePostDelete($postNo){
    $sql=" delete from post WHERE commentNo ='".$postNo."' || no='".$postNo."'";
    $data= $this->Dbconnect->exec($sql);
    return $data;
}

public function orderDelete($orderNo){
    $sql=" delete from card WHERE cart_id ='".$orderNo."' ";
    $data= $this->Dbconnect->exec($sql);
    return $data;
}
public function confirmProductInformationByNo($id){
    $sql = "SELECT user_id_To FROM product_confirm WHERE no ='".$id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();

    return $satatus;
}public function confirmProductInformation($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct,$transactionId){
    $dataArray=array($user_id,$parent_id,$confirm_name,$address,$item_need,$pnumber,$parents_ids,$unitsofproduct,$transactionId);
    $sql="insert into product_confirm(user_id_From,user_id_To,name,address,item,pnumber,product,units,transaction,date,time)VALUES (?,?,?,?,?,?,?,?,?,now(),now())";
    $sth=$this->Dbconnect->prepare($sql);
    $status=$sth->execute($dataArray);
    return $status;
}
public function viewBuyersInfo(){
    $sql = "SELECT * FROM users where status = 'yes' && position = 'Buyer'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function viewSellerInfo(){
    $sql = "SELECT * FROM users where status = 'yes'  && position = 'Seller' ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function viewExpertInfo(){
    $sql = "SELECT * FROM users where status = 'yes'  && position = 'Expert' ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();
    return $status;
}
public function viewSellerBuyersTotalInfo($buyers_id,$sellers_id){
    $sql = "SELECT * FROM chat where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."' ORDER BY no DESC";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();

    $updates = "update chat set messageRead = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
    $this->Dbconnect->exec($updates);

    return $satatus;
}
public function viewSellerBuyersTotalInfoS($buyers_id,$sellers_id){
    $sql = "SELECT * FROM chat where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."' ORDER BY no DESC";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();

    $update = "update chat set message = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
    $this->Dbconnect->exec($update);

    return $satatus;
}
    public function addPayment($user_id,$name,$amount,$phone,$transaction_id,$date){
        $dataArray=array($user_id,$name,$amount,$phone,$transaction_id,$date);
        $sql="insert into payment(user_id,name,amount,phone,transaction_id,date)VALUES (?,?,?,?,?,?)";
        $sth=$this->Dbconnect->prepare($sql);
        $status=$sth->execute($dataArray);
        return $status;
    }
public function insertMessageForChat($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
    $dataArray=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
    $sql="insert into chat(buyers_id,sellers_id,buyers_name,sellers_name,message_from,date,time)VALUES (?,?,?,?,?,now(),now())";
    $sth=$this->Dbconnect->prepare($sql);
    $status=$sth->execute($dataArray);
    $update = "update chat set messageRead = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
    $this->Dbconnect->exec($update);
    return $status;
}
public function insertMessageForChatSellers($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message){
    $data=array($buyers_id,$sellers_id,$buyers_name,$sellers_name,$chat_message);
    $sql="insert into chat(buyers_id,sellers_id,buyers_name,sellers_name,message_to,date,time)VALUES (?,?,?,?,?,now(),now())";
    $sth=$this->Dbconnect->prepare($sql);
    $status=$sth->execute($data);
    $update = "update chat set message = 'seen' where buyers_id = '".$buyers_id."' &&  sellers_id = '".$sellers_id."'";
    $this->Dbconnect->exec($update);
    return $status;
}
public function showAlertonMessage($sellers_id){
    $message = "unseen";
    $sql = "select buyers_id, message from chat where  sellers_id = '".$sellers_id."' &&  message='".$message."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();

    return $status;
}
public function showAlertonMessageforbuyers($id){
    $message = "unseen";
    $sql = "select sellers_id, messageRead from chat where buyers_id = '".$id."' && messageRead='".$message."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $status = $data->fetchAll();

    return $status;
}
public function showSellerAccount($user_id){

    $sql = "SELECT * FROM users where user_id = '".$user_id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
public function insertUserData($name,$email,$position,$password,$image,$emailToken){

    $array = array($name,$email,$position,$password,$image,$emailToken);
    $sql = "insert into users (name,email,position,password,image,emailtoken) VALUE (?,?,?,?,?,?)";
    $data = $this->Dbconnect->prepare($sql);
    $status = $data->execute($array);
    return $status;
}
public function insertSellerData($name,$email,$phone,$shop_name,$address){

    $array = array($name,$email,$phone,$shop_name,$address);
    $sql = "insert into users (name,email,phone,shop_name,address) VALUE (?,?,?,?,?)";
    $data = $this->Dbconnect->prepare($sql);
    $status = $data->execute($array);
    return $status;
}
public function insertCartProduct($price,$name,$item_id,$seller_id,$buyer_id,$phone){

    $array = array($price,$name,$item_id,$seller_id,$buyer_id,$phone);
    $sql = "insert into card (price,name,item_id,seller_id,buyer_id,phone,confirm_date) VALUE (?,?,?,?,?,?,now())";
    $data = $this->Dbconnect->prepare($sql);
    $status = $data->execute($array);
    return $status;
}
public function insertItem($product_id,$seller_id,$name,$price,$category,$image,$description){

    $array = array($product_id,$seller_id,$name,$price,$category,$image,$description);
    $sql = "insert into item (product_id,seller_id,product_name,price,category,image,description) VALUE (?,?,?,?,?,?,?)";
    $data = $this->Dbconnect->prepare($sql);
    $status = $data->execute($array);
    return $status;
}
    public function addCategory($user_id,$category){
        $array = array($user_id,$category);
        $sql = "insert into category (user_id,category, date) VALUE (?,?,now())";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
public function checkEmailInUserTable($email){

    $sql = "SELECT * FROM users where email = '".$email."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
public function checkAllproduct($id){

    $sql = "SELECT * FROM item where seller_id = '".$id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function searchProduct($id, $name){

    $sql = "SELECT * FROM item where seller_id = '".$id."' && product_name like '%$name%' ";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function AllMyProduct($id){

    $sql = "SELECT * FROM item where seller_id = '".$id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function checkItem($product_id,$seller_id){

    $sql = "SELECT * FROM item where seller_id = '".$seller_id."' && item_id='".$product_id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}

public function showCardData($id,$seller_id){

    $sql = "SELECT * FROM card where status='no' && buyer_id = '".$id."' && seller_id = '".$seller_id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function showBuyerDataById($id){

    $sql = "SELECT * FROM users where user_id = '".$id."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
    public function showAdminDataById($id){

        $sql = "SELECT * FROM admin where admin_id = '".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
public function showAllPendingAccount(){

    $sql = "SELECT * FROM users where status != 'yes'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetchAll();
    return $satatus;
}
public function checkEmail($email){

    $sql = "SELECT * FROM admin where email = '".$email."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
    public function updateAdminImage($image,$id){

        $array = array($image);
        $sqls = "update admin set image=? WHERE  admin_id='".$id."'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
public function checkConfirmCode($email,$code){

    $sql = "SELECT * FROM users where email = '".$email."' && emailtoken='".$code."'";
    $data = $this->Dbconnect->query($sql);
    $data->setFetchMode(\PDO::FETCH_OBJ);
    $satatus = $data->fetch();
    return $satatus;
}
    public function showAllNotice(){

        $sql = "SELECT * FROM notice";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAdminData($id){

        $sql = "SELECT * FROM admin WHERE admin_id!='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function ShowAllProduct(){

        $sql = "SELECT * FROM item ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllUserData(){

        $sql = "SELECT * FROM users WHERE position != 'Expert' &&  status='yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllExpertData(){

        $sql = "SELECT * FROM users WHERE position = 'Expert' &&  status='yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllTransactionData(){

        $sql = "SELECT * FROM payment ORDER  BY date DESC ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function checkRating($id,$client_id){

        $sql = "SELECT * FROM rating WHERE user_id='".$id."' && client_id='".$client_id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function totalRating($id){

        $sql = "SELECT count(rating) as countRating, count(client_id) as totalClient, SUM(rating) as sumRating,AVG(rating) as averageRating FROM rating WHERE user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function sellerById($id){

        $sql = "SELECT * FROM users WHERE user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showSelleData($id){

        $sql = "SELECT * FROM users WHERE user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showItemByCardId($id){

        $sql = "SELECT * FROM card WHERE cart_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showItemImage($id){

        $sql = "SELECT * FROM item WHERE item_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showAllPostById($id){

        $sql = "SELECT * FROM post WHERE user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showPostById($id){

        $sql = "SELECT * FROM post WHERE no='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function checkGift($id){

        $sql = "SELECT * FROM gift WHERE user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function checkPosition($position){

        $sql = "SELECT * FROM gift WHERE position='".$position."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showAllGiftData(){

        $sql = "SELECT * FROM `gift` ORDER BY order_position ASC";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function countLimit(){

        $sql = "SELECT COUNT(id) as total FROM gift";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function countTotalSell($id){

        $sql = "SELECT COUNT(cart_id) as total FROM card WHERE seller_id = '".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }

    public function showAllShopData(){

        $sql = "SELECT * FROM users WHERE position='Seller'  && status ='yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllRatingGroupBy(){

        $sql = "SELECT rat_id, user_id, SUM(rating) AS Rating, COUNT(user_id) AS Users FROM `rating` GROUP BY user_id;";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showRatingById($id){

        $sql = "SELECT sum(rating) as total_rating FROM rating WHERE user_id ='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public  function  insertRate($user_id,$client_id,$coutnRating,$total){
        $array = array($user_id,$client_id,$coutnRating,$total);
        $sql = "insert into rating (user_id,client_id,rating,total) VALUE (?,?,?,?)";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public function TotalPendingAccount(){

        $sql = "SELECT count(user_id) as total FROM users WHERE status='no'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function totalMypost($id){

        $sql = "SELECT count(no) as total FROM post WHERE  user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function TotalShop(){

        $sql = "SELECT count(shop_name) as total FROM users where position='Seller'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function TotalControlAccount(){

        $sql = "SELECT count(user_id) as total FROM users WHERE status='yes'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public  function  insertNotice($title,$notice){
        $array = array($title,$notice);
        $sql = "insert into notice (title,notice,date,time) VALUE (?,?,now(),now())";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public  function  insertGift($id,$position,$order){
        $array = array($id,$position,$order);
        $sql = "insert into gift (user_id,position,order_position,date) VALUE (?,?,?,now())";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public  function  addPost($user_id, $title,$name,$post,$image){
        $array = array($user_id, $title,$name,$post,$image);
        $sql = "insert into post (user_id,title,name,post,image,date,time) VALUE (?,?,?,?,?,now(),now())";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public  function  insert_new_admin($name,$email,$phone,$password,$image){
        $array = array($name,$email,$phone,$password,$image);
        $sql = "insert into admin (name,email,phone,password,image) VALUE (?,?,?,?,?)";
        $data = $this->Dbconnect->prepare($sql);
        $status = $data->execute($array);
        return $status;
    }
    public function updateNotice($id,$title,$notice){

        $array = array($title,$notice);
        $sqls = "update notice set title=?, notice=? WHERE  id='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function editPostWithImage($id,$title,$post,$image){

        $array = array($title,$post,$image);
        $sqls = "update post set title=?, post=?, image=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function confirmPayment($id){
        $statusCheck='yes';
        $array = array($statusCheck);
        $sqls = "update payment set status=? WHERE  id='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function editPostWithOutImage($id,$title,$post){

        $array = array($title,$post);
        $sqls = "update post set title=?, post=? WHERE  no='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function updateItem($item_id,$updateProductName,$updatePrice,$description){

        $array = array($updateProductName,$updatePrice,$description);
        $sqls = "update item set product_name=?, price=?,description=? WHERE  item_id='" . $item_id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
    public function confirmOrder($id,$date){
        $status='yes';
        $array = array($status,$date);
        $sqls = "update card set confirm_status=?,delivery_date=? WHERE  cart_id='" . $id . "'";
        $data = $this->Dbconnect->prepare($sqls);
        $status = $data->execute($array);
        return $status;
    }
public function updateAdminRegisterToken($emailToken, $userEmail){

    $array = array($emailToken);
    $sqls = "update admin set emailtoken=? WHERE  email='" . $userEmail . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function UpdatePostName($name,$user_id){

    $array = array($name);
    $sqls = "update post set name=? WHERE  user_id='" . $user_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
    public function showNoticeById($id){

        $sql = "SELECT * FROM notice where id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }public function statusCheckItem($buyer_id,$seller_id,$item_id){

        $sql = "SELECT * FROM card where status = 'no' && item_id='".$item_id."' && buyer_id='".$buyer_id."' && seller_id='".$seller_id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showShopDataByid($id){

        $sql = "SELECT * FROM users where user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }    public function showOrderDataByOrderId($id){

        $sql = "SELECT * FROM product_confirm where no='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
    public function showMyOrderHistoryById($id){

        $sql = "SELECT * FROM card where seller_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllTransactionById($id){

        $sql = "SELECT * FROM payment where user_id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showCategory(){

        $sql = "SELECT * FROM category ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function showAllAdmin(){

        $sql = "SELECT * FROM admin";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetchAll();
        return $satatus;
    }
    public function viewOwnerInfo(){
        $sql = "SELECT * FROM users where status = 'yes'  && position = 'Seller' ";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetchAll();
        return $status;
    }
    public function showCategoryByCategoryId($id){

        $sql = "SELECT * FROM category where id='".$id."'";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $satatus = $data->fetch();
        return $satatus;
    }
public function UpdateSellerData($name,$email,$phone,$shop_name,$address,$user_id){

    $array = array($name,$email,$phone,$shop_name,$address);
    $sqls = "update users set name=?,email=?,phone=?,shop_name=?, address=? WHERE  user_id='" . $user_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function UpdateBuyerData($name,$email,$phone,$address,$user_id){

    $array = array($name,$email,$phone,$address);
    $sqls = "update users set name=?,email=?,phone=?, address=? WHERE  user_id='" . $user_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function UpdateBuyerprofile($name,$email,$phone,$shop_name,$address,$user_id){

    $array = array($name,$email,$phone,$shop_name,$address);
    $sqls = "update users set name=?,email=?,phone=?,shop_name=?,address=? WHERE  user_id='" . $user_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}

public function updateUserRegisterToken($emailToken, $userEmail){

    $array = array($emailToken);
    $sqls = "update users set emailtoken=? WHERE  email='" . $userEmail . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateQuantity($cart_id,$totalQuantity,$totalPrice){

    $array = array($totalQuantity,$totalPrice);
    $sqls = "update card set quantity=?,uprice=? WHERE  cart_id='" . $cart_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateMailStatus($order_id){
    $emailStatus='yes';
    $array = array($emailStatus);
    $sqls = "update product_confirm set mail_status=? WHERE  no='" . $order_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function verifyUserToken($password,$email,$otp){

    $array = array($password);
    $sqls = "update users set password=?, emailtoken='yes' WHERE  emailtoken='".$otp."'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateAdminData($name,$phone,$address,$email,$password,$id){

    $array = array($name,$phone,$address,$email,$password);
    $sqls = "update admin set name=?, phone=?, address=?, email=?, password=? WHERE  admin_id='".$id ."'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateUserToken($otp,$pass){
    $emailtoken='yes';
    $array = array($pass);
    $sqls = "update users set password=? WHERE  emailtoken='" . $otp . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function verifyAdminToken($code,$pass){

    $array = array($pass);
    $sqls = "update admin set password=?, emailtoken='yes' WHERE  emailtoken='" . $code . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function changeBuyerPassword($id,$new_password){

    $array = array($new_password);
    $sqls = "update users set password=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateSellerPass($new_password,$user_id){

    $array = array($new_password);
    $sqls = "update users set password=? WHERE  user_id='" . $user_id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateSellerProfileWithImage($name,$email,$phone,$shop_name,$address,$new_password,$image,$id){

    $array = array($name,$email,$phone,$shop_name,$address,$new_password,$image);
    $sqls = "update users set name=?,email=?,phone=?,shop_name=?,address=?,password=?,image=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}

public function updateAdminProfileWithImage($name,$email,$phone,$address,$new_password,$image,$id){

    $array = array($name,$email,$phone,$address,$new_password,$image);
    $sqls = "update admin set name=?,email=?,phone=?,address=?,password=?,image=? WHERE  admin_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateSellerProfileWithOutImage($name,$email,$phone,$shop_name,$address,$new_password,$id){

    $array = array($name,$email,$phone,$shop_name,$address,$new_password);
    $sqls = "update users set name=?,email=?,phone=?,shop_name=?,address=?,password=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateAdminProfileWithOutImage($name,$email,$phone,$address,$new_password,$id){

    $array = array($name,$email,$phone,$address,$new_password);
    $sqls = "update admin set name=?,email=?,phone=?,address=?,password=? WHERE  admin_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateSellerPhoto($image,$id){

    $array = array($image);
    $sqls = "update users set image=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}public function cartUpdateConfirm($buyer_id,$seller_id,$transactionId){

//    $array = array($image);
    $sqls = "update card set status='yes',transaction_id='".$transactionId."' WHERE  seller_id = '".$seller_id."' && buyer_id='" . $buyer_id . "'";
    $data = $this->Dbconnect->exec($sqls);
    //$status = $data->execute($array);
    return $data;
}
public function updateToken($email){
    $token='yes';
    $array = array($token);
    $sqls = "update users set emailtoken=? WHERE  email='" . $email . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function confirmAccount($id){
    $statusCheck='yes';
    $array = array($statusCheck);
    $sqls = "update users set status=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function updateShopPhoto($image,$id){

    $array = array($image);
    $sqls = "update users set shop_image=? WHERE  user_id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
public function UpdateCategoryById($id,$category){

    $array = array($category);
    $sqls = "update category set category=? WHERE  id='" . $id . "'";
    $data = $this->Dbconnect->prepare($sqls);
    $status = $data->execute($array);
    return $status;
}
    public function deleteNotice($id)
    {
        $sql = "delete from  notice WHERE id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deletePost($id)
    {
        $sql = "delete from  post WHERE no = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function delete_admin($id)
    {
        $sql = "delete from  admin WHERE admin_id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deleteRating($user_id,$client_id)
    {
        $sql = "delete from  rating WHERE user_id = '".$user_id."' && client_id = '".$client_id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function delete_gift($id)
    {
        $sql = "delete from  gift WHERE id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deleteItemId($id)
    {
        $sql = "delete from  item WHERE item_id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deleteCategoryById($id)
    {
        $sql = "delete from  category WHERE id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deleteAccount($id)
    {
        $sql = "delete from  users WHERE user_id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }
    public function deletecard($id)
    {
        $sql = "delete from  card WHERE cart_id = '".$id."'";
        $data = $this->Dbconnect->exec($sql);
        return $data;
    }

}