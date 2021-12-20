<?php
require_once "../functions.php";
session_start();
check_login();
check_organizer();

$cid = $_POST['cid'];
$uid = $_SESSION['user_id'];

$bool = true;

if(isset($_POST['bool'])){
    $bool = 0;
}


//Check if organizer owns the concert before doing any changes for the tickets
$curlAuth = curl_init();

curl_setopt_array($curlAuth, array(
CURLOPT_URL => 'http://dss-proxy:4001/api/concerts/'.$cid,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTPHEADER => array('X-Auth-Token: '.$_SESSION['token']),
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curlAuth);
curl_close($curlAuth);
$resArray = json_decode($response,true);


//Update sold out attribute only if current user owns the concert
if(array_key_exists("organizer",$resArray[0]) && $resArray[0]["organizer"]==$uid){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "http://orion-proxy:4002/v2/entities/".$cid."/attrs/soldout");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"value\": ".$bool.",
    \"type\": \"Boolean\"
  }");

  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Auth-Token: '.$_SESSION['token'],
    'Content-Type: application/json'
  ));

  $response = curl_exec($ch);
  curl_close($ch);

  echo json_encode(array("response"=>"success"));

}else{
  echo json_encode(array("response"=>"notauthorized"));

}


