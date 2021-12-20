<?php

include("../mongoconnection.php");
use MongoDB\BSON\ObjectID;

if($conn){
    if(isset($_POST['nid'])){
        $nid = $_POST['nid'];
        $uid = $_POST['uid'];

        $action = array('$set' => array('seen'=>true));
        $query = [
            '_id' => new ObjectID(strval($nid)),
            'user_id' => intval($uid)
        ];        
        $notifications->updateOne($query,$action);

    }else{
        echo "fail";
    }
}


?>