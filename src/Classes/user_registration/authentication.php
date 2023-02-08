<?php

namespace App\user_registration;
use App\Model\Database as DB;

class authentication extends DB
{



    public function checkUserEmail($email,$password){
    $sql="select * from users WHERE email ='$email' && password='$password'";
    $sth=$this->Dbconnect->query($sql);
    $sth->setFetchMode(\PDO::FETCH_OBJ);
    $data=$sth->fetch();
    return $data;
}
public function checkActive($email,$password){
    $sql="select * from users WHERE email ='$email' && password='$password' && status = 'yes'";
    $sth=$this->Dbconnect->query($sql);
    $sth->setFetchMode(\PDO::FETCH_OBJ);
    $data=$sth->fetch();
    return $data;
}

public function checkAdminEmail($email,$password){
    $sql="select * from admin WHERE email ='$email' && password='$password'";
    $sth=$this->Dbconnect->query($sql);
    $sth->setFetchMode(\PDO::FETCH_OBJ);
    $data=$sth->fetch();
    return $data;
}

    public function checkPaymentById($id){
//        $sql="select * from payment WHERE user_id='$id'";
        $sql="SELECT * FROM payment WHERE user_id ='$id' ORDER BY ID DESC LIMIT 1";
        $sth=$this->Dbconnect->query($sql);
        $sth->setFetchMode(\PDO::FETCH_OBJ);
        $data=$sth->fetch();
        return $data;
    }


    public function checkPaymentSatatus($currentDate,$paymentDate)
    {
        $sql = "SELECT DATEDIFF( '".$paymentDate."', '".$currentDate."') as day";
        $data = $this->Dbconnect->query($sql);
        $data->setFetchMode(\PDO::FETCH_OBJ);
        $status = $data->fetch();
        return $status;

    }


}