<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_user();
    
    $idconcert = $_POST['fid'];
    $userID = $_SESSION['user_id'];
    $delQuery = "DELETE FROM favorites WHERE user_id = $userID AND concert_id = $idconcert";
    mysqli_query($con, $delQuery);
?>