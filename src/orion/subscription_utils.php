<?php
check_login();
check_user();

function addOrionSubscription($cid){

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
            "url": "http://dss-core:80/api/handle/update"
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

      curl_setopt($ch, CURLOPT_URL, "http://orion-proxy:4002/v2/subscriptions");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, TRUE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $newSub);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-Auth-Token: '.$_SESSION['token']
      ));
      
      $response = curl_exec($ch);
      curl_close($ch);

      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
      $header = substr($response, 0, $header_size);
      $hdrArray = http_parse_headers($header);

      $newSubID="";
      try{
          $newSubID = $hdrArray['location'];
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

        $newSubData = '{
          "concert_id":'.$cid.',
          "user_id":'.$uid.',
          "orion_id":"'.$newSubID.'",
          "sdate":"'.$sdate.'",
          "edate":"'.$edate.'"          
        }';

        $rest_request = "http://dss-proxy:4001/api/subscription/new";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $newSubData);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
        $response = curl_exec($client);

        curl_close($client);
      }


}

function getEntityByID($cid){

    $curl = curl_init();

    $uid = $_SESSION['user_id'];
    $rest_request = "http://orion-proxy:4002/v2/entities/".$cid."?type=concert&options=keyValues";

    curl_setopt_array($curl, array(
        CURLOPT_URL => $rest_request,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_HTTPHEADER => array('X-Auth-Token: '.$_SESSION['token']),
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

function disassociateDBsubscription($orionid){
    $uid = $_SESSION['user_id'];

    $post = [
      'orion_id' => $orionid,
      'uid' => $uid,
    ];
  
  $ch = curl_init('http://dss-proxy:4001/api/subscription/remove');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
  curl_exec($ch);
  curl_close($ch);
}


function getOrionID($cid){
  $uid = $_SESSION['user_id'];

  $rest_request = "http://dss-proxy:4001/api/subscription/user/".$uid."/concert/".$cid;
  $client = curl_init($rest_request);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($client, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
  $response = curl_exec($client);
  curl_close($client);
  $result = json_decode($response,true);
  return $result[0]["orion_id"];
}



//Checks if concert entity in orion is entered. Only if the entity is created users can subscribe to it
function availableForSubscriptions($cid){
    //If the entity of the concert is not yet created by the organizer no users can be subscribed

    //Request orion for the concert entity   
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "http://orion-proxy:4002/v2/entities/".$cid."?options=keyValues");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Accept: application/json',
       'X-Auth-Token: '.$_SESSION['token']));

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
function isSubscribed($cid){
    $uid = $_SESSION['user_id'];

    $rest_request = "http://dss-proxy:4001/api/subscription/user/".$uid."/concert/".$cid;
    $client = curl_init($rest_request);
    curl_setopt($client, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response,true);

    if(array_key_exists(0,$result)){
      if(array_key_exists("orion_id",$result[0])){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
}

//Rest request to remove subscription from orion and disassociate document in local db
function removeOrionSubscription($cid){

  $ch = curl_init();

  $orion_id = getOrionID($cid);
  $url = "http://orion-proxy:4002/v2/subscriptions/".$orion_id;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));  
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  
  $response = curl_exec($ch);

  curl_close($ch);
  disassociateDBsubscription($orion_id);
}

?>
