<?php

$dbhost = "db";
$dbuser = "root";
$dbpass = "root";
$dbname = "jukebox";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
 
    die("Connection to database could not be established...");
}