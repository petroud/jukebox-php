<?php
    include("../mongoconnection.php");

    //Create notification for specific user_id
    if($conn){
        
        $data = json_decode(file_get_contents('php://input'), true);

        $data=$data[0];

        $msg=$data['message'];
        $tfprint=$data['timestamp'];
        $uid=$data['uid'];

        $fields = array('message'=>$msg,'timestamp'=>$tfprint,"seen"=>false , "user_id"=>intval($uid));
        $notifications->insertOne($fields);
    }
?>