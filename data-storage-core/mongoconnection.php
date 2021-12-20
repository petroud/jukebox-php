<?php
    require 'config/vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://admin:admin@10.1.2.7:27018");
    $db = $conn->jukebox;

    $concerts = $db->concerts;
    $favorites = $db->favorites;
    $notifications = $db->notifications;
    $subscriptions = $db->subscriptions;
?>