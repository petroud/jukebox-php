<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_user();
    
    $idconcert = $_GET['id'];
    $userID = $_SESSION['user_id'];

    $checkQuery = "SELECT * FROM favorites WHERE user_id = $userID AND concert_id = $idconcert";
   
    $result = mysqli_query($con, $checkQuery); 
    if(is_null($result)){
        $delQuery = "DELETE FROM favorites WHERE user_id = $userID AND concert_id = $idconcert";
        mysqli_query($con, $delQuery);
    }else{
        $addQuery = "INSERT INTO favorites(id,user_id,concert_id) values('$userID". $idconcert ."', '$userID','$idconcert')";
        mysqli_query($con, $addQuery);
    }

    
    $queryStruct = "UPDATE users SET confirmed = NOT confirmed WHERE id='$idToChangeConfState'";
    mysqli_query($con,$queryStruct);
    header("Location: ../administration.php");
?>