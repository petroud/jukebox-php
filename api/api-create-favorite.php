<?php
    include("../mongoconnection.php");

    if($conn){
        $data = json_decode(file_get_contents('php://input'), true);
        $uid = $data['uid'];
        $cid = $data['cid'];

        $exists = $favorites->find(array('user_id'=>strval($uid), 'concert_id'=>strval($cid) ) )->toArray();

        if(count($exists)){
            die;
        }else{
            $favorites->insertOne(array('_id'=>strval($uid).strval($cid), 'user_id'=>strval($uid), 'concert_id'=>strval($cid)));
            die;
        }
    }
    
?>