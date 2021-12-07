<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login();
    check_organizer();
    $title = $artist = $genre = $date= "";

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData);
    $dataArr = (array)$data;

    $cid = $dataArr['cid'];
    $title = $dataArr['title'];
    $artist = $dataArr['artist'];
    $genre = $dataArr['genre'];
    $date = $dataArr['date'];

    if(isset($cid) && !empty($cid)){
        // Get hidden input value
        $uid = $_SESSION['user_id'];
        
        // Validate name
        $input_title = trim($title);
        $input_artist = trim($artist);
        $input_genre = trim($genre);
        $input_date = ($date);
    
        if(empty($input_title) || empty($input_artist) || empty($input_genre) || empty($input_date)){
            echo json_encode(["response"=>"Please fill in all fields"]);
            die;
        } else{
            $q_title = $input_title;
            $q_artist = $input_artist;
            $q_genre = $input_genre;
            $q_date = $input_date;
        }
         


        // Prepare an update statement
        $data = array(
            'cid' => $cid,
            'oid' => $uid,
            'title' => $q_title,
            'artistname' => $q_artist,
            'genre' => $q_genre,
            'date' => $q_date
        );
    
        $reqData = json_encode($data);
        
        $rest_request = "http://localhost:80/api/concert/update";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $reqData);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        echo json_encode(["response"=>"Successful Update"]);
        die;
    }

?>