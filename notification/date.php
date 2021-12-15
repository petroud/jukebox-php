<?php

$datetime1 = new DateTime('2021-12-15 22:13:06');//start time
$datetime2 = new DateTime('2021-12-21 11:55:09');//end time
$interval = $datetime1->diff($datetime2);
echo $interval->format('%d days %H hours %i minutes %s seconds');