<?php
    require 'config/vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://admin:admin@192.168.1.11:27018");
    $db = $conn->jukebox;

    $users = $db->users;
    $concerts = $db->concerts;
    $favorites = $db->favorites;
?>