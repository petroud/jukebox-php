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
curl_setopt($ch, CURLOPT_URL, "http://dss-proxy:4001/api/concerts/".$cid);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
$output = curl_exec($ch);
curl_close($ch);

addNewNotification($output,1);
