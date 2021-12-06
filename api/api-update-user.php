<?php
    include("../mongoconnection.php");
    
    if($conn){
        if(isset($_GET['id'])){
            $uid = $_GET['id'];
            $data = json_decode(file_get_contents('php://input'), true);
            $exists = $users->find(array('_id'=>strval($uid)))->toArray();

            $fname=$data['fname'];
            $lname=$data['lname'];
            $email=$data['email'];
            $role=$data['role'];
            if(count($exists)){
                $action = array('$set' => array('name'=>$fname,'surname'=>$lname,'email'=>$email,'role'=>$role));
                $users->updateOne(['_id'=>strval($uid)],$action);
            }else{
                echo "Failed...";
            }
        }
    }

?>