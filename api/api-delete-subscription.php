<?php
     include("../mongoconnection.php");

     if($conn){
         if(isset($_POST['orion_id']) && isset($_POST['uid'])){
             $orion_id = $_POST['orion_id'];
             $uid = $_POST['uid'];
             
             $query = [
                'orion_id' => strval($orion_id),
                'user_id' => intval($uid)
             ];

             print_r($query);
             $subscriptions->deleteOne($query);
         }else{
             echo "error...";
         }
     }
?>