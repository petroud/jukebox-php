<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_admin();
    
    $idToChangeConfState = $_POST['uid'];
    if($_SESSION['user_id'] === $idToChangeConfState or $idToChangeConfState == 1){
        $error="Not Allowed";
        echo $error;
        die;
    }
   
    $rest_request = "http://localhost:80/api/user/status/".$idToChangeConfState;
    $client = curl_init();
    curl_setopt($client, CURLOPT_URL,$rest_request);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
?>