<?php

$dbhost = "10.1.2.6";
$dbuser = "keyrock";
$dbpass = "keyrock";
$dbname = "jukebox";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
 
    die("Connection to database could not be established...");
}
