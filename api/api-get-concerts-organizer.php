<?php
    //Headers for proxy GET
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: GET');


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