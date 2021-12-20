<?php
session_start();
include "../functions.php";
check_login();
check_user();


$uid = $_SESSION['user_id'];
$nid = $_POST['nid'];

$postFields = [
    'nid' => strval($nid),
    'uid' => intval($uid)
];

$ch = curl_init('http://dss-proxy:4001/api/notifications/seen');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token: '.$_SESSION['token']));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_exec($ch);
curl_close($ch);

?>