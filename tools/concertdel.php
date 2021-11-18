<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_organizer();

    $idToDelete = $_POST['cid'];
    $uid = $_SESSION['user_id'];

    $authQuery = "SELECT * FROM concerts WHERE id=$idToDelete AND organizer=$uid";
    $authResult = mysqli_query($con,$authQuery);
    if($authResult){
        $queryStruct = "DELETE FROM concerts WHERE id=$idToDelete";
        mysqli_query($con,$queryStruct);
    }else{
        die;
    }
?>