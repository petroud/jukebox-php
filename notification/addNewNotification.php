<?php
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
        $msg6 = "Dates of ticket sales for concert '";
        $msg7 = "' are now scheduled from ";
        $msg8 = " to ";
        $msg9 = " again after they have been sold out";


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
            case 5:
                $notifMsg = $msg6.$cname.$msg7.$sdate.$msg8.$edate;
                break;
            case 6:
                $notifMsg = $msg2.$cnmae.$msg4.$msg9;
                break;
            default:
                die;
        }
        $datetime = new DateTime();
        $time = $datetime->format('y-m-d H:i:s');


        $data = array(
            'message' => $notifMsg,
            'timestamp' => $time,
            'uid' => $uid
        );

        $reqData = json_encode($data);

        $rest_request = "http://localhost:80/api/notifications/new";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $reqData);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);

        curl_close($client);
        die;
    
    }
?>