<?php

    header('Content-Type: application/json');

    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['uid']) && isset($_GET['cid'])){
            $uid = $_GET['uid'];
            $cid = $_GET['cid'];
            $idanswer = $favorites->find(array('user_id'=>strval($uid), 'concert_id'=>strval($cid)))->toArray();
            echo json_encode($idanswer, JSON_PRETTY_PRINT);
            die;
        }
    }
?>