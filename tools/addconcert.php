<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_organizer();
    $title = $artist = $genre = $date= "";    

    $uid = $_SESSION['user_id'];

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData);
    $dataArr = (array)$data;

    $title = $dataArr['title'];
    $artist = $dataArr['artistname'];
    $genre = $dataArr['genre'];
    $date = $dataArr['date'];
    
    $input_title = trim($title);
    $input_artist = trim($artist);
    $input_genre = trim($genre);
    $input_date = ($date);

    if(empty($input_title) || empty($input_artist) || empty($input_genre) || empty($input_date)){
        echo json_encode(["response"=>"Please fill in all fields!"]);
        die;
    } else{
        $q_title = $input_title;
        $q_artist = $input_artist;
        $q_genre = $input_genre;
        $q_date = $input_date;
    }
        

    //Insertion REST call
        $data = array(
            'oid' => $uid,
            'title' => $q_title,
            'artistname' => $q_artist,
            'genre' => $q_genre,
            'date' => $q_date
        );
    
        $reqData = json_encode($data);
        
        $rest_request = "http://localhost:80/api/concert/new";
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $reqData);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        echo json_encode(["response"=>"New concert added!","newID"=>$response]);
        die;
?>