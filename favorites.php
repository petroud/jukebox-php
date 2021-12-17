<?php
session_start();

    include("connection.php");
    include("functions.php");
    check_login($con);
    check_user();
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Favorites </title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/concerts.css">
    <link rel="stylesheet" href="/src/notifications.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/src/favorites.js"> </script>
    <script src="/src/welcome.js"> </script>
    <script src="/src/subscribtion.js"> </script>
    <script src="/src/notification.js"> </script>

    <style>
        body {
          background-image: url('cdn/background.jpg');
          background-repeat: no-repeat;
          background-size: 100% 100%;
          background-attachment: fixed;
          font-family: "Roboto",sans-serif;
          font-family: 'Work Sans', sans-serif;
          overflow:auto;
        }
        html{
            scroll-behavior: smooth;
        }
    
        </style>
</head>



<body>
    <div class="banner">
            <div class="navbar">
                <div class="logo">
                  <a href="index.php"><img src="cdn/logo.png"></a>
                </div>
                <div class="dropdown">
                    <button class="dropbtn waving">
                        <?php
                            if($_SESSION['user_role'] === "ADMIN"){
                                echo 'ADMIN';
                            }elseif($_SESSION['user_role'] === "ORGANIZER"){
                              echo 'ORGANIZER';
                            }elseif($_SESSION['user_role'] === "USER"){
                              echo 'USER';
                            }else{
                                echo 'Internal Error';
                                die;
                            }
                        ?>
                        MENU</button>
                     <div class="dropdown-content">

                         <?php
                            if($_SESSION['user_role'] === "ADMIN"){
                                echo '<a href="administration.php">User Catalog Tools</a>';
                            }elseif($_SESSION['user_role'] === "ORGANIZER"){
                                echo '<a href="organizer.php">Organizer Tools</a>';
                            }elseif($_SESSION['user_role'] === "USER"){
                                echo '<a href="concerts.php">Concerts</a>';
                                echo '<a href="favorites.php">Favorites</a>';
                            }else{
                                echo 'Internal Error';
                                die;
                            }
                        ?>

                         <a href="mailto:admin@jukebox.com">Report a problem</a>
                        
                     </div>
                </div>

                <?php
                if($_SESSION['user_role'] === "USER"){
                 echo '<button class="notifbtn"  onclick="notifyme()"><img src="assets/bell.png" alt="Notifications" id="notifImg"></button>
                    <div class="notifications" id="notifs">
                        <div class="notification-content" id="notBox">
                            
                        </div>

                    </div>';
                }?>

                <div>      
                    <button id="logoutBtn" type="button" class="logoutbtn" title="Sign out from <?php echo $_SESSION['uname'];?>">
                        <img src="assets/logout.png" alt="Logout">
                    </button>
                </div>
                <div>
                  <span> <img src="/assets/user.png" alt="User icon" class = "userico">
                   <p class="userinfo">
                       <?php 
                            printf("%s %s (%s)",$_SESSION['last_name'],$_SESSION['first_name'], $_SESSION['user_role']);
                       ?>
                   </p>
                    </span>
                </div>

            </div>

            <div class="content">

                <h1><span class="waving"> Browse your favorite concerts and events</span></h1>

                <div class="concert-container">
                    <ul class="concert-list">
                        <?php

                        $rest_request = "http://localhost:80/api/favorites/".$_SESSION['user_id'];
                        $client = curl_init($rest_request);
                        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($client);
                        curl_close($client);
                        $result = json_decode($response,true);
                        $uid = $_SESSION['user_id'];
                        if(count($result) > 0){
                            foreach($result as $row){
                                echo '<li class="concert-box" id="fave'.$row['_id'].'">';
                                echo '<div><h1>\'\'' . $row['title'] . '\'\'</h1></div>';
                                echo '<div><h2>Artists: ' . $row['artistname'] . '</h2></div>';
                                echo '<div><h2>Category: ' . $row['category'] . '</h2></div>';
                                echo '<div><p>Date: ' . $row['date'] . '<br>By: ' . getUnameByID($row['organizer'],$con)['email'] . '</p></div>';
                                echo '<div><button class="favorite-button" onclick="delFave('. $row['_id'] .')"><img src="/assets/remove.png" alt="rfave"></button></div>';
                                echo '</li>';
                            }
                        }           
                        
                        ?>
                    </ul>
                </div>
                <div class="divider"> 
                </div>

              
                
            </div>
            <div></div>
    </div>
</body>