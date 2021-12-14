<?php
 session_start();
 include("../functions.php");
 check_login();
 check_organizer();

 $jsonData = file_get_contents('php://input');
 $data = json_decode($jsonData);
 $dataArr = (array)$data;

 $cid = $dataArr['cid'];
 $uid = $_SESSION['user_id'];

 $sdate = $dataArr['sdate'];
 $edate = $dataArr['edate'];

 if(!empty($sdate) && !empty($edate)){
     if($sdate>$edate){
         echo json_encode(array("response"=>"dateerror"));
         die;
     }
 }else{
    echo json_encode(array("response"=>"dateerror"));
    die;
 }

//Check if organizer owns the concert before doing any changes for the tickets
$curlAuth = curl_init();

curl_setopt_array($curlAuth, array(
CURLOPT_URL => 'localhost:80/api/concerts/'.$cid,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curlAuth);
curl_close($curlAuth);


$resArray = json_decode($response,true);


if(array_key_exists("organizer",$resArray[0]) && $resArray[0]["organizer"]==$uid){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => '192.168.1.11:1026/v2/entities?options=keyValues',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "id":"'.$cid.'",
    "type": "concert",
    "startdate": "'.$sdate.'",
    "enddate": "'.$edate.'",
    "organizer": "'.$uid.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    echo json_encode(array("response"=>"success"));

}else{
    echo json_encode(array("response"=>"notauthorized"));

}

?>