<?php
    include("../mongoconnection.php");
        
    if($conn){
        
        $data = json_decode(file_get_contents('php://input'), true);

        $title=$data['title'];
        $artist=$data['artistname'];
        $genre=$data['genre'];
        $date=$data['date'];
        $uid=$data['oid'];

        $cond = [];
        $options = ['projection' => ['title'=>0,'category'=>0,'date'=>0,'organizer'=>0, 'artistname'=>0,'_id'=>1], 'sort'=>['$natural'=>-1], 'limit'=>1];
        $lastID = $concerts->find($cond,$options)->toArray();
        try{
            $newID=  $lastID[0]['_id']+ 1;
        }catch(Exception $ex){
            $newID= 1;
        }

        $fields = array('_id'=>strval($newID),'title'=>$title,'artistname'=>$artist,'category'=>$genre,'date'=>$date,'organizer'=>strval($uid));
        $concerts->insertOne($fields);
        $newDoc = $concerts->find($fields)->toArray();
        echo $newDoc[0]['_id'];
    }
?>