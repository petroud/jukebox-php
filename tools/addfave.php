<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_user();
    
    $idconcert = $_POST['fid'];
    $userID = $_SESSION['user_id'];
    $addQuery = "INSERT INTO favorites(id,user_id,concert_id) values(".$userID.$idconcert.",$userID,$idconcert)";
    mysqli_query($con, $addQuery);
?>