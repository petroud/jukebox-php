<?php
session_start();
require_once "../functions.php";
require_once "../connection.php";
include("../parser.php");
include("subscription_utils.php");
check_login();
check_user();

$cid = $_POST['cid'];
$uid = $_SESSION['user_id'];

removeOrionSubscription($cid,$con);