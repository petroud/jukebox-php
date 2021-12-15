<?php
    include("../functions.php");
    include("../connection.php");
    session_start();
    check_login();
    check_user();
    date_default_timezone_set('Europe/Athens');

    $uid = $_SESSION['user_id'];
 
    $userNots = array();

    $sqlQuery = "SELECT * FROM notifications WHERE user_id=$uid LIMIT 30";

    $result = mysqli_query($con,$sqlQuery);

    $newDiv = "";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $dateCreated = $row['footprint'];
            $time = timeInterval($dateCreated)." ago";
            $data = array("msg"=>$row['message'],"time"=>timeInterval($row['footprint'])." ago");
            array_push($userNots,$data);
        }
    }else{
        echo "non are returned...";
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