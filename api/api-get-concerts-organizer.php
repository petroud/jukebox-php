<?php
    include("../mongoconnection.php");
    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $answer = $concerts->find(array('organizer'=>strval($id)))->toArray();
            echo json_encode($answer, JSON_PRETTY_PRINT);
            die;
        }
    }
?>