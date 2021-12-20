<?php

    header('Content-Type: application/json');

    include("../mongoconnection.php");

    //If client has set an ID on the request the return specific concert, else return all concerts
    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $answer = $concerts->find(array('_id'=>strval($id)))->toArray();
            echo json_encode($answer, JSON_PRETTY_PRINT);
            die;
        }else{
            $answer = $concerts->find()->toArray();
            echo json_encode($answer, JSON_PRETTY_PRINT) ;            
            die;
        }
    }
    
?>