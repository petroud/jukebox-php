<?php
include("../mongoconnection.php");
use MongoDB\BSON\ObjectID;

if($conn){
    if(isset($_POST['nid'])){
        $nid = $_POST['nid'];
        $action = array('$set' => array('seen'=>true));
        $query = [
            '_id' => new ObjectID(strval($nid))
        ];        
        print_r($query);
        $notifications->updateOne($query,$action);

    }else{
        echo "fail";
    }
}


?>