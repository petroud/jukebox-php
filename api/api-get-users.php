<?php
    
    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $answer = $users->find(array('_id'=>strval($id)))->toArray();
            echo json_encode($answer);
            die;
        }else{
            $answer = $users->find()->toArray();
            echo json_encode($answer, JSON_PRETTY_PRINT) ;            
            die;
        }
    }
    
?>
