<?php
    include("../mongoconnection.php");
    
    if($conn){
        
        $data = json_decode(file_get_contents('php://input'),true);
        print_r($data);
        $oid=$data['orion_id'];
        $sdate=$data['sdate'];
        $edate=$data['edate'];
        $sout=$data['sout'];

        $action = array('$set' => array('sdate'=>strval($sdate),'edate'=>strval($edate),'soldout'=>$sout));
        $subscriptions->updateOne(['orion_id'=>strval($oid)],$action);
        
    }

?>