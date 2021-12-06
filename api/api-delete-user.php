<?php
    include("../mongoconnection.php");

    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $answer = $users->deleteOne(array('_id'=>strval($id)));
            echo json_encode($answer);
            die;
        }
    }
?>