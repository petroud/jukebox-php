<?php
session_start();
include("../functions.php");
check_login();
check_organizer();

$cid = $_POST['cid'];
$bool = true;

if(isset($_POST['bool'])){
    $bool = 0;
}


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:1026/v2/entities/".$cid."/attrs/soldout");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"value\": ".$bool.",
  \"type\": \"Boolean\"
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json"
));

$response = curl_exec($ch);
curl_close($ch);
