<?php
    require './config/vendor/autoload.php';

    if($conn = new MongoDB\Client("mongodb://admin:admin@localhost:27017")){
    	echo "Succesfull";
	die;
    }	
    echo "Error...";
?>