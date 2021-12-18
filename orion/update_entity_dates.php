<?php
 session_start();
 require_once "../functions.php";
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

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:1026/v2/entities/".$cid."/attrs?options=keyValues");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

    curl_setopt($ch, CURLOPT_POSTFIELDS,'{
    "startdate": "'.$sdate.'",
    "enddate": "'.$edate.'"
    }');

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);

    echo $response;
    curl_close($ch);

    echo json_encode(array("response"=>"success"));

}else{
    echo json_encode(array("response"=>"notauthorized"));

}