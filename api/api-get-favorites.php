<?php
    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $idanswer = $favorites->find(array('user_id'=>strval($id)))->toArray();
            $favArray = array();
            foreach($idanswer as $pivot){
                array_push($favArray, $concerts->find(array('_id'=>strval($pivot['concert_id'])))->toArray());
            } 
            $concertArray = [];
            foreach($favArray as $item){
                $concertArray = array_merge($concertArray,$item);
            }
            echo json_encode($concertArray, JSON_PRETTY_PRINT);
            die;
        }
    }
    
?>