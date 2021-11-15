<?php
    session_start();
    include("../connection.php");
    include("../functions.php");
    $user_data = check_login($con);
    check_admin();

    $idToDelete = $_POST['uid'];
    if($_SESSION['user_id'] === $idToDelete or $idToDelete == 1){
        die;
    }
    $queryStruct = "DELETE FROM users WHERE id=$idToDelete";
    mysqli_query($con,$queryStruct);
?>