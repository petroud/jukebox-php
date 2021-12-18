<?php
include("../mongoconnection.php");

//Create subscription for specific user_id on specific concert_id
if($conn){
    
    $data = json_decode(file_get_contents('php://input'), true);

    $cid=$data['concert_id'];
    $uid =$data['user_id'];
    $orion_id = $data['orion_id'];
    $sdate = $data['sdate'];
    $edate = $data['edate'];

    $fields = array('orion_id'=>$orion_id,'user_id'=>intval($uid), "concert_id"=>intval($cid),"sdate"=>$sdate, "edate"=>$edate, "soldout"=>false,"start_parsed"=>false,"end_parsed"=>false,"soldout_parsed"=>false);
    $subscriptions->insertOne($fields);
}



?>