<?php

    $json = json_decode(file_get_contents("php://input"));

    $file = "accumulate.txt";

    file_put_contents($file,json_encode($json));

?>