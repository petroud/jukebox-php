<?php
    require 'config/vendor/autoload.php';
    $conn = new MongoDB\Client("mongodb://localhost:27017");
    $db = $conn->jukebox;

    $users = $db->users;
    $concerts = $db->concerts;
    $favorites = $db->favorites;
?>