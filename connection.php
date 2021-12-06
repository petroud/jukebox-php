<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jukebox";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
 
    die("Connection to database could not be established...");
}