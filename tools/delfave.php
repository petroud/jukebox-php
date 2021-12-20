<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    check_login();
    check_user();
    
    $rest_request = "http://dss-proxy:4001/api/favorite/delete/".$_SESSION['user_id']."/".$_POST['fid'];
    $client = curl_init();
    curl_setopt($client, CURLOPT_URL,$rest_request);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, "");
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
    $response = curl_exec($client);
    curl_close($client);
?>