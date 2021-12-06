<?php

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData);
    $uid = $data['uid'];
    $fname = $data['fname'];
    $lname = $data['lname'];
    $email = $data['email'];
    $role = $data['role'];
    echo $email;

?>