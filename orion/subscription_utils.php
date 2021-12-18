<?php

function addOrionSubscription($cid,$con){

    $uid = $_SESSION['user_id'];

    if(!isset($_SESSION['user_id'])){
        die;
    }

    $newSub = '{
        "description": "Subscription for receiving updates on concert with id '.$cid.' for user '.$uid.'",
        "subject": {
          "entities": [
            {
              "id": "'.$cid.'",
              "type": "concert"
            }
          ],
          "condition": {
            "attrs": [
              "startdate",
              "enddate",
              "soldout"
            ]
          }
        },
        "notification": {
          "http": {
            "url": "http://192.168.1.10:80/orion/accumulate.php?uid='.$uid.'"
          },
          "attrs": [
            "startdate",
            "enddate",
            "soldout"
          ]
        },
        "expires": "2050-04-05T14:00:00.00Z"
      }';

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:1026/v2/subscriptions");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, TRUE);
      
      curl_setopt($ch, CURLOPT_POST, TRUE);
      
      curl_setopt($ch, CURLOPT_POSTFIELDS, $newSub);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
      ));
      
      $response = curl_exec($ch);

      curl_close($ch);

      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
      $header = substr($response, 0, $header_size);
      $hdrArray = http_parse_headers($header);

      $newSubID="";
      try{
          $newSubID = $hdrArray['Location'];
          $newSubID = substr($newSubID,18);
      }catch(Exception $ex){
      }

      //Acquire entity data to store to local database
      $entity=getEntityByID($cid);

      $entityData=json_decode($entity,true);

      $sdate = $entityData['startdate'];
      $edate = $entityData['enddate'];
      $sout = $entityData['soldout'];


      if(empty($newSubID)){
          die;
      }else{
        //Store the new subscription to local database for further procedure for notification prodcution later
        $bool = 'false';
        if($sout){
            $bool = 'true';
        }
        $sqlQuery = "INSERT INTO subscriptions(orion_id,user_id,concert_id,sdate,edate,soldout) VALUES('$newSubID',$uid,$cid,'$sdate','$edate',$bool)";
        mysqli_query($con,$sqlQuery);
      }


}

function getEntityByID($cid){

    $curl = curl_init();

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

        return json_encode($resArray);
       
    }
}

function disassociateDBsubscription($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "DELETE FROM subscriptions WHERE concert_id=$cid AND user_id = $uid";
    mysqli_query($con,$sqlQuery);
}

function parseStartDate($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "UPDATE subscriptions set start_parsed=true WHERE concert_id=$cid AND user_id = $uid";
    mysqli_query($con,$sqlQuery);
}

function unparseStartDate($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "UPDATE subscriptions set start_parsed=false WHERE concert_id=$cid AND user_id = $uid";
    mysqli_query($con,$sqlQuery);
}

function parseEndDate($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "UPDATE subscriptions set end_parsed=true WHERE concert_id=$cid AND user_id = $uid";
    mysqli_query($con,$sqlQuery);
}

function unparseEndDate($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "UPDATE subscriptions set end_parsed=false WHERE concert_id=$cid AND user_id = $uid";
    mysqli_query($con,$sqlQuery);
}


function getOrionID($cid,$con){
  $uid = $_SESSION['user_id'];
  $sqlQuery = "SELECT orion_id FROM subscriptions WHERE concert_id=$cid AND user_id=$uid";
  $response = mysqli_query($con,$sqlQuery);
  if($response && mysqli_num_rows($response)>0){
       $answer = mysqli_fetch_assoc($response);
       $orion_id = $answer['orion_id'];
       return $orion_id;
  }
}



//Checks if concert entity in orion is entered. Only if the entity is created users can subscribe to it
function availableForSubscriptions($cid){
    //If the entity of the concert is not yet created by the organizer no users can be subscribed

    //Request orion for the concert entity   
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:1026/v2/entities/".$cid."?options=keyValues");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Accept: application/json'
    ));

    $response = curl_exec($ch);
    curl_close($ch);
    $dataArr = json_decode($response,true);

    if(array_key_exists("error",$dataArr)){
        return false;
    }else{
        return true;
    }
}

//Checks if user is subscribed to the $cid defined concert by looking into subscriptions db
function isSubscribed($cid,$con){
    $uid = $_SESSION['user_id'];

    $sqlQuery = "SELECT * FROM subscriptions WHERE concert_id=$cid AND user_id=$uid";

    $result = mysqli_query($con,$sqlQuery);

    if(mysqli_num_rows($result)>0){
        return true;
    }
}

function removeOrionSubscription($cid,$con){

  $ch = curl_init();

  $orion_id = getOrionID($cid,$con);

  $url = "http://192.168.1.11:1026/v2/subscriptions/".$orion_id;
  echo $url;
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  
  $response = curl_exec($ch);

  curl_close($ch);
  disassociateDBsubscription($cid,$con);
}

?>