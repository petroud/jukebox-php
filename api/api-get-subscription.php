<?php

include("../mongoconnection.php");

if($conn){
    if(isset($_GET['uid']) && isset($_GET['cid'])){
        
        $uid = intval($_GET['uid']);
        $cid = intval($_GET['cid']);

        $data = [
            "concert_id"=>intval($cid),
            "user_id"=>intval($uid)
        ];
        
        $cursor = $subscriptions->find($data)->toArray();
        echo json_encode($cursor);
    }elseif (isset($_GET['subid'])) {
        $oid= strval($_GET['subid']);
        $data = [
            "orion_id"=>strval($oid)
        ];
        $cursor = $subscriptions->find($data)->toArray();
        echo json_encode($cursor);
    }
}