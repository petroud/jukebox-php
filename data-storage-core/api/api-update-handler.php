<?php
    date_default_timezone_set('Europe/Athens');

    $json = json_decode(file_get_contents("php://input"),true);

    $subID = $json['subscriptionId'];

    $cid = $json['data'][0]['id'];

    //Find old values of subscription attributes
    $rest_request = "http://localhost:80/api/subscription/orionid/".$subID;

    $client = curl_init($rest_request);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $data = json_decode($response,true);

    $sdate_old = $data[0]['sdate'];
    $edate_old = $data[0]['edate'];
    $sout_old = $data[0]['soldout'];
    $user_id = $data[0]['user_id'];

    $sdate_new = $json['data'][0]['startdate']['value'];
    $edate_new = $json['data'][0]['enddate']['value'];
    $sout_new = $json['data'][0]['soldout']['value'];

    // Prepare an update statement
    $reqData='{
        "orion_id":"'.$subID.'",
        "sdate":"'.$sdate_new.'",
        "edate":"'.$edate_new.'",
        "sout":'.$sout_new.'
    }';

    //Patch updates to local MongoDB
    $rest_request = "http://localhost:80/api/subscription/update";
    $client = curl_init();
    curl_setopt($client, CURLOPT_URL,$rest_request);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $reqData);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);

    //Get the concert name from REST API of Data-Storage-Service
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:80/api/concerts/".$cid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $ans = json_decode($output,true);
    $title = $ans[0]['title'];

    //Check which of the new data has changed and created required notification
    $newNotif = "";
    
    //If the dates have changed inform user about change in dates
    if($sdate_new!=$sdate_old || $edate_new!=$edate_old){
        $message = "Dates for ticket sales of concert '".$title."' changed to: '".$sdate_new." - ".$edate_new."'";
        $time = new DateTime();
        $timestamp = $time->format('y-m-d H:i:s');
        $newNotif = '{
            "message" :"'.$message.'",
            "timestamp":"'.$timestamp.'",
            "uid":'.intval($user_id).'            
        }';

        //Produce notification to MongoDB
        $rest_request = "http://localhost:80/api/notifications/new";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $newNotif);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_exec($client);
        curl_close($client);
    }

    if($sout_old!=$sout_new){
        //If the soldout state has changed inform user about new sold out state
        if(!$sout_new){
            $message = "Tickets for concert '".$title."' are available again!";
            $time = new DateTime();
            $timestamp = $time->format('y-m-d H:i:s');

            $newNotif = '{
                "message" :"'.$message.'",
                "timestamp":"'.$timestamp.'",
                "uid":'.intval($user_id).'            
            }';
        }else{
            $message = "Tickets for concert '".$title."' are now sold out";
            $time = new DateTime();
            $timestamp = $time->format('y-m-d H:i:s');
            $newNotif = '{
                "message" :"'.$message.'",
                "timestamp":"'.$timestamp.'",
                "uid":'.intval($user_id).'            
            }';
        }

        //Produce notification to MongoDB
        $rest_request = "http://localhost:80/api/notifications/new";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $newNotif);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_exec($client);
        curl_close($client);
    }else{
        //Should not reach this, since if this script is executed, orion has posted here data after changes have happened
        die;
    }


?>