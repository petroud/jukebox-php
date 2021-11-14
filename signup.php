<?php
session_start();
    include("connection.php");
    include("functions.php");
    $user_data = already_login($con);
    

    $data_empty_error = $email_format_error = $uname_exists_error = $email_exists_error = $pass_mismatch_error = false;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted

        //collect username password email name etc.
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $email = $_POST['mail'];
        $username = $_POST['user_name'];
        $pass = $_POST['pass_word'];
        $passrepeat = $_POST['pass_word_repeat'] ?? null;
        $role = $_POST['role_select'];
                
        if(!empty($firstname) && !empty($lastname) && !empty($email) &&!empty($username) && !empty($pass) && !empty($passrepeat)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $result_uname = mysqli_query($con, "select * from users where username= '$username'");
                $result_email = mysqli_query($con, "select * from users where email= '$email' ");
               
                if($pass === $passrepeat){
                    if(mysqli_num_rows($result_uname)>0){
                        $uname_exists_error = true;
                    }else{
                        if(mysqli_num_rows($result_email)>0){
                            $email_exists_error = true;
                        }else{
                            $query = "insert into users(name,surname,username,password,email,role,confirmed) values('$firstname','$lastname','$username','$pass','$email','$role',FALSE)";
                            mysqli_query($con, $query);
                            header("Location: login.php");
                        }
                    }
                }else{
                    $pass_mismatch_error = true;
                }
            }else{
                $email_format_error = true;
            }
        }else{
            $data_empty_error = true;
        }
    }
?>






<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Sign Up</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/signup.css">
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
                <div class="logo">
                     <a href="index.php"><img src="cdn/logo.png"></a>
                </div>
                <div class="menu-icons">
                    <a href="login.php"><img src="assets/login.png" alt="Log In"></a>
                    <a href="mailto:admin@jukebox.com"><img src="assets/alert.png" alt="Report a problem"></a>
                </div>
            </div>

            <div class="content">
                <div>
                    <form method = "POST">
                        <h1 class="waving-text">Please fill in your information</h1>
                        <input type="text" class = "input-box" placeholder= "First Name" name ="first_name">
                        <input type="text" class = "input-box" placeholder= "Last Name" name="last_name">
                        <input type="text" class = "input-box" placeholder= "yourname@example.com" name="mail">
                        <input type="text" class = "input-box" placeholder= "Username" name="user_name">
                        <input type="password" class = "input-box" placeholder= "Password" name="pass_word">
                        <input type="password" class = "input-box" placeholder= "Repeat Password" name="pass_word_repeat">

                        <select style="color:gray" name="role_select" id="role" class = "input-box styleselect">
                            <option value="ADMIN">Admin</option>
                            <option value="ORGANIZER">Organizer</option>
                            <option value="USER">User</option>
                        </select><br><br>

                        <input type="submit" class = "waving button" value="SIGN UP"><br><br>
                        <?php
                            if($email_format_error){
                                echo '<p class="error-msg"><span> Please use a valid email address </span></p>';
                            }
                            if($data_empty_error){
                                echo '<p class="error-msg"><span> Please fill in all required fields</span></p>';
                            }
                            if($pass_mismatch_error){
                                echo '<p class="error-msg"><span> Passwords do not match. Please try again</span></p>';
                            }
                            if($uname_exists_error){
                                echo '<p class="error-msg"><span> This username is already in use. Please try again</span></p>';
                            }
                            if($email_exists_error){
                                echo '<p class="error-msg"><span> This email has already been used. Please try again</span></p>';
                            }
                        ?>
                        <a href="login.php" class = "sign-up-ref"> Already have an account? Log in </a>
                    </form>                   
                </div>

                <div>
                    <img src="assets/favicon.png" class="favi">
                    <h5 class = "favitext">© 2021 JUKEBOX</h5>
                </div>
               
            </div>
    </div>
</body>