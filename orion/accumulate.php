<?php
    include("../connection.php");
    include("../notification/addNewNotification.php");

    $json = json_decode(file_get_contents("php://input"),true);

    $file = "accumulate.txt";  

    $subID = $json['subscriptionId'];

    $cid = $json['data'][0]['id'];

    $sdate_new = $json['data'][0]['startdate']['value'];
    $edate_new = $json['data'][0]['enddate']['value'];
    $sout_new = $json['data'][0]['soldout']['value'];

    //Find old values of subscription attributes
    $sqlQuery = "SELECT * FROM subscriptions WHERE orion_id='$subID'";
    $response = mysqli_query($con,$sqlQuery);
    if(mysqli_num_rows($response)>0){
        $data = mysqli_fetch_assoc($response);
        $sdate_old = $data['sdate'];
        $edate_old = $data['edate'];
        $sout_old = $data['sout'];
    }
    //Sync local database with orion new updates
    $sqlUpdate = "UPDATE subscriptions SET sdate='$sdate_new',edate='$edate_new',soldout=$sout_new WHERE orion_id='$subID'";
    $response = mysqli_query($con,$sqlUpdate);  
    file_put_contents($file,$sqlUpdate);

    

    //Get the concert name from REST API of Data-Storage-Service
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:80/api/concerts/".$cid);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $ans = json_decode($output,true);
    $title = $ans['title'];
    die;

    //Check which of the new data has changed and created required notification

    //If the dates have changed inform user about change in dates
    if($sdate_new!=$sdate_old || $edate_new!=$edate_old){


    }else if($sdate_old!=$sdate_new){
        //If the soldout state has changed inform user about sold out state
        addNewNotification(1,$con,5);
    }else{
        //Should not reach this, since if this script is executed orion has posted here data after changes have happened
        die;
    }

?>