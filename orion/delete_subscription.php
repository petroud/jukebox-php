<?php
session_start();
require_once "../functions.php";
include("../parser.php");
include("subscription_utils.php");
check_login();
check_user();

$cid = $_POST['cid'];

removeOrionSubscription($cid);