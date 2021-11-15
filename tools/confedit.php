<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_admin();
    
    $idToChangeConfState = $_POST['uid'];
    if($_SESSION['user_id'] === $idToChangeConfState or $idToChangeConfState == 1){
        $error="Not Allowed";
        echo $error;
        die;
    }
    $queryStruct = "UPDATE users SET confirmed = NOT confirmed WHERE id=$idToChangeConfState";
    mysqli_query($con,$queryStruct);
?>