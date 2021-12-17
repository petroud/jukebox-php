<?php
    session_start();
    include_once("../functions.php");
    check_login();
    check_user();
    date_default_timezone_set('Europe/Athens');


    function addNewNotification($jsonData,$con,$case){
        $uid = $_SESSION['user_id'];
        $data = json_decode($jsonData,true);
        
        //Case variable specifies the message selection for this new notification created    
        // Case 1: new subscription
        // Case 2: ticket sales started
        // Case 3: tickets sold out
        // Case 4: tickets sales ended
    
        if(isset($data[0]['title'])){
            $cname= $data[0]['title'];
        }else{
            echo "invalid args";
            die;
        }

        $msg1 = "You are now subscribed for receiving updates on ticket sales for concert ";
        $msg2 = "Tickets for concert '";
        $msg3 = "' are now sold out";
        $msg4 = "' are now available";
        $msg5 = "' are no longer available from today";


        $notifMsg = "";

        switch($case){
            case 1:
                $notifMsg = $msg1."'".$cname."'";
                break;
            case 2:
                $notifMsg = $msg2.$cname.$msg4;            
                break;
            case 3:
                $notifMsg = $msg2.$cname.$msg3;            
                break;
            case 4:
                $notifMsg = $msg2.$cname.$msg5;            
                break;
            default:
                die;
        }
        $datetime = new DateTime();
        $time = $datetime->format('y-m-d h:i:s');
       
        $sqlQuery = "INSERT INTO notifications(user_id,message,seen,footprint) values($uid,\"$notifMsg\",false,'$time')";
        $response = mysqli_query($con,$sqlQuery);   
    }
?>