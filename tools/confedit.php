<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    include("../user_database.php");

    check_login();
    check_admin();
    
    $idToChangeConfState = $_POST['uid'];
    if($_SESSION['user_id'] === $idToChangeConfState or $idToChangeConfState == 1){
        $error="Not Allowed";
        echo $error;
        die;
    }else{
        toggleUserStatus($idToChangeConfState,$con);
    }

?>