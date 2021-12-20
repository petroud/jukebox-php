<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    include("../user_database.php");
    check_login();
    check_admin();

    $idToDelete = $_POST['uid'];
    if($_SESSION['user_id'] === $idToDelete){
        die;
    }else{
        deleteUser($idToDelete,$_SESSION['xtoken'],$con);
    }
    

?>