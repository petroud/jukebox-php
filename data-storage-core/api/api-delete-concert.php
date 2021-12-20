<?php
    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['cid']) && isset($_GET['uid'])){
            $cid = $_GET['cid'];
            $uid = $_GET['uid'];
            $auth=$concerts->find(['_id'=>strval($cid), 'organizer'=>strval($uid)])->toArray();
            if(count($auth)){
                $answer = $concerts->deleteOne(array('_id'=>strval($cid),'organizer'=>strval($uid)));
            }else{
                echo "Not authorized or not found...";
            }
            die;
        }else{
            echo "error...";
        }
    }
?>