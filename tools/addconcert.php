<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_organizer();
    $title = $artist = $genre = $date= "";    

    $uid = $_SESSION['user_id'];
    
    $input_title = trim($_POST["title"]);
    $input_artist = trim($_POST["artist"]);
    $input_genre = trim($_POST["genre"]);
    $input_date = ($_POST["date"]);

    if(empty($input_title) || empty($input_artist) || empty($input_genre) || empty($input_date)){
        die;
    } else{
        $q_title = $input_title;
        $q_artist = $input_artist;
        $q_genre = $input_genre;
        $q_date = $input_date;
    }
        
    $sql = "INSERT INTO concerts(title,artistname,date,category,organizer) values('$q_title','$q_artist','$q_date','$q_genre','$uid')";
    mysqli_query($con,$sql);
    
    $retrieveID = "SELECT id FROM concerts WHERE title='$q_title' AND artistname='$q_artist' AND date='$q_date' AND category='$q_genre' AND organizer=$uid ORDER BY id DESC LIMIT 1";

    $gotback = mysqli_query($con,$retrieveID);
    $rarray = mysqli_fetch_assoc($gotback);
    $newcid = $rarray['id'];

    echo $newcid;
    die;

?>