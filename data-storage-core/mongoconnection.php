<?php
    require 'config/vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://admin:admin@mongo:27017");
    $db = $conn->jukebox;

    $concerts = $db->concerts;
    $favorites = $db->favorites;
    $notifications = $db->notifications;
    $subscriptions = $db->subscriptions;
?>
