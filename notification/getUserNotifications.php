<?php
    require_once "../functions.php";
    session_start();
    check_login();
    check_user();
    date_default_timezone_set('Europe/Athens');

    $uid = $_SESSION['user_id'];
 
    $userNots = array();


    $rest_request = "http://localhost:80/api/notifications/".$uid;
    $client = curl_init($rest_request);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response,true);

    foreach($result as $row){
        $nid = $row['_id']['$oid'];
 
        $data = array("msg"=>$row['message'],"time"=>timeInterval($row['timestamp'])." ago","seen"=>$row['seen'],"notifID"=>$nid);
        array_push($userNots,$data);
    }

    echo(json_encode($userNots));
    die;


    function timeInterval($date){
        $argTime = new DateTime($date);
        $datetime = new DateTime();
        

        $interval = $argTime->diff($datetime);

        $yearInterval = $interval->format('%y');
        $monthInterval = $interval->format('%m');
        $dayInterval = $interval->format('%d');
        $hoursInterval = $interval->format('%h');
        $minsInterval = $interval->format('%i');
        $secondsInterval = $interval->format('%s');
        
        if($yearInterval>0){
            if($yearInterval==1){
                return $yearInterval." year";
            }else{
                return $yearInterval." years";
            }
        }
        elseif($monthInterval>0){
            if($monthInterval==1){
                return $monthInterval." year";
            }else{
                return $monthInterval." years";
            }
        }
        elseif($dayInterval>0){

            if($dayInterval==1){
                return $dayInterval." day";
            }else{
                return $dayInterval." days";
            }

        }elseif($hoursInterval>0){

            if($hoursInterval==1){
                return $hoursInterval." hour";
            }else{
                return $hoursInterval." hours";
            }

        }elseif($minsInterval>0){

            if($minsInterval==1){
                return $minsInterval." minute";
            }else{
                return $minsInterval." minutes";
            }
        }elseif($secondsInterval>0){

            return $secondsInterval." seconds";

        }else{
            return "NaN time";
        }
    }
?>