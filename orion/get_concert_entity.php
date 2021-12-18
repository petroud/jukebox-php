<?php
 require_once "../functions.php";

 session_start();
 check_login();
 check_organizer();

$curl = curl_init();

$cid = $_GET['cid'];
$uid = $_SESSION['user_id'];
$rest_request = "http://192.168.1.11:1026/v2/entities/".$cid."?type=concert&options=keyValues";

curl_setopt_array($curl, array(
  CURLOPT_URL => $rest_request,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
$resArray = json_decode($response,true);

if(array_key_exists("error",$resArray)){

    echo json_encode(array("response"=>"notfound"));

}elseif(array_key_exists("id",$resArray)){

    if($resArray["organizer"] == $uid){
        echo json_encode($resArray);
    }else{
        echo json_encode(array("response"=>"notauthorized"));
    }
}
?>