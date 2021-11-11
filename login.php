<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = already_login($con);
   
   
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        if(!empty($username) && !empty($password)){
            $query = "select * from users where username = '$username' limit 1";
            $result = mysqli_query($con, $query);
            if($result){
                if($result && mysqli_num_rows($result) > 0){
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password){
                        $_SESSION['user_id'] = $user_data['id'];
                        header("Location: welcome.php");
                        die;
                    }
                }
            }
        }else{
            echo "Please review your information";
        }
    }
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Log in</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="./src/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="./src/main.js"></script>

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
                <div class="logo">
                  <a href="index.php"><img src="cdn/logo.png"></a>
                </div>
                <div class="menu-icons">
                    <a href="signup.php"><img src="assets/signup.png" alt="Sing Up"></a>
                    <a href="mailto:admin@jukebox.com"><img src="assets/alert.png" alt="Report a problem"></a>
                </div>
            </div>

            <div class="content">

                <div>
                    <form method = "POST">
                        <h1 class="waving-text">Please enter your credentials</h1>
                        <input name = "uname" type="text" class = "input-box" placeholder= "Username">
                        <input name = "pass" type="password" class = "input-box" placeholder= "Password"><br><br>
                        <input type="submit" class = "waving button" value="LOGIN"><br><br>
                        <a href="signup.php" class = "sign-up-ref"> Don't have an account? Sign up </a>
                    </form>
                   
                   
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