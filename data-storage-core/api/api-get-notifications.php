<?php

header('Content-Type: application/json');

include("../mongoconnection.php");

//Return notifications of a specific user 
if($conn){
    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];

        $query = [
            'user_id' => intval($uid)
        ];
        
        $options = [
            'projection' => [
                'message' => 1.0,
                'timestamp' => 1.0,
                'seen' => 1.0
            ]
        ];
        
        $answer = $notifications->find($query, $options);

        echo json_encode($answer->toArray(),JSON_PRETTY_PRINT);
        
    }
}

?>