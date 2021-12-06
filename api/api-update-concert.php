<?php
    include("../mongoconnection.php");
    
    if($conn){
        
        $data = json_decode(file_get_contents('php://input'), true);

        $title=$data['title'];
        $artist=$data['artistname'];
        $genre=$data['genre'];
        $date=$data['date'];
        $cid=$data['cid'];
        $uid=$data['oid'];

        $auth=$concerts->find(['_id'=>strval($cid), 'organizer'=>strval($uid)])->toArray();
        if(count($auth)){
            $action = array('$set' => array('title'=>$title,'artistname'=>$artist,'category'=>$genre,'date'=>$date));
            $concerts->updateOne(['_id'=>strval($cid)],$action);
        }else{
            echo "Not authorized...";
        }
        
    }

?>