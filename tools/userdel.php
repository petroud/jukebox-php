<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_admin();


    $idToDelete = $_GET['id'];
    if($_SESSION['user_id'] === $idToDelete or $idToDelete == 1){
        header("Location: ../administration.php");
        die;
    }
    $queryStruct = "DELETE FROM users WHERE id='$idToDelete'";
    mysqli_query($con,$queryStruct);
    header("Location: ../administration.php");
?>