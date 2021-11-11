<?php
//Starting the session
session_start();
$_SESSION;

    include("connection.php");
    include("functions.php");


?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Home</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="./src/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="src/main.js"></script>

    <style>
        body {
          background-image: url('cdn/background.jpg');
          background-repeat: no-repeat;
          background-size: 100% 100%;
          background-attachment: fixed;
          font-family: "Roboto",sans-serif;
          font-family: 'Work Sans', sans-serif;
        }
        </style>
</head>



<body>
    <div class="banner">
            <div class="navbar">
                <div class="logo fade-in">
                    <a href="index.php"><img src="cdn/logo.png"></a>
                </div>
                <div class="menu-icons">
                    <a href="login.php"><img src="assets/login.png" alt="Login"></a>
                    <a href="signup.php"><img href="signup.php" src="assets/signup.png" alt="Sign Up"></a>
                </div>
            </div>

            <div class="content fade-in">
                <h1>MUSIC UNITES US</h1>
                <h3 class="waving-text">Join concerts and music events around the world</h3>

                <div>
                    <button id="loginBtn" type="button" class="waving">
                        LOGIN
                    </button>
                    <button id="signupBtn" type="button" class="btn-2">
                        SIGN UP
                    </button>
                </div>
                <div>
                    <img src="assets/favicon.png" class="favi">
                    <h5 class = "favitext">© 2021 JUKEBOX</h5>
                </div>
                <div class="caption">
                    <h4>
                        -Live Aid 13/7/1985<br>
                         Queen performing 'Bohemian Rhapsody'
                    </h4>
                </div>
            </div>
    </div>
</body>