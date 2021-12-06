<?php
    include("../mongoconnection.php");
    
    if($conn){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $options = ['projection'=>['name'=>0, 'surname'=>0, 'password'=>0, 'email'=>0,'role'=>0]];
            $statusResult = $users->find(['_id'=>strval($id)], $options)->toArray();
            $status = $statusResult[0]['confirmed'];
            $users->updateOne( array('_id'=>strval($id)) , array('$set' => array('confirmed'=>!$status)) );
        }
    }
?>