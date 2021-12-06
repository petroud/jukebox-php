<?php
    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['uid']) && isset($_GET['cid'])){
            $uid = $_GET['uid'];
            $cid = $_GET['cid'];
            $answer = $favorites->deleteOne(array('user_id'=>strval($uid),'concert_id'=>strval($cid)));
            echo json_encode($answer);
            die;
        }
    }
?>