<?php
session_start();
require_once "../functions.php";
include("../parser.php");
include("../notification/addNewNotification.php");
include("subscription_utils.php");
check_login();
check_user();

$cid = $_POST['cid'];
$uid = $_SESSION['user_id'];

addOrionSubscription($cid);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:80/api/concerts/".$cid);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

addNewNotification($output,1);
