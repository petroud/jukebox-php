<?php
session_start();
include("../functions.php");
include("../connection.php");

$uid = $_SESSION['user_id'];
$nid = $_POST['nid'];

$sqlQuery = "UPDATE notifications SET seen=true WHERE id=$nid AND user_id=$uid";
mysqli_query($con,$sqlQuery);

?>