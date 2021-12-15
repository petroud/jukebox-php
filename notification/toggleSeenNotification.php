<?php
    include("../connection.php");
    include("../functions.php");
    session_start();
    check_login();
    check_user();

    $nid = $_POST['notif_id'];
    $id = $_SESSION['user_id'];

    if(isset($nid)){
        $sqlQuery = "UPDATE notifications SET seen=TRUE WHERE $id=$nid AND $user_id=$id";
        mysqli_query($con,$sqlQuery);
    }
?>