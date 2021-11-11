<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
?>


<!DOCTYPE html>

<html>
    <head>
        <title>Home Page</title>
    </head>
    <body>
        <h1>Welcome!</h1>

        <a href="logout.php"><h3>Logout</h3></a>
    </body>
</html>