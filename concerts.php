<?php
session_start();

    include("connection.php");
    include("functions.php");
    include("parser.php");
    include("orion/subscription_utils.php");

    $user_data = check_login($con);
    check_user();

    function isFave($cid){

        $rest_request = "http://localhost:80/api/checkfavorite/".$_SESSION['user_id']."/".$cid;
        $client = curl_init($rest_request);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response,true);

        if(count($result)){
            return true;
        }else{
            return false;
        }
    }
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Concerts </title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/concerts.css">
    <link rel="stylesheet" href="/src/notifications.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="/src/concerts.js"> </script>
    <script src="/src/filter.js"> </script>
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
    <div class = "filter-button-div" id="filterBtn">
            <button onclick ="showFilters()" class="filter-button"><img src="/assets/filter.png" alt="Filter Concerts"></button>
    </div>
    <div class = "filter-box" id="filterBox">
            <div class = "title"><h1>Filters</h1></div>
            
            <div><h2>Title</h2>
            <input type="text" class="input-box" id="titleCriteria" placeholder="Enter concert title">
            </div>
            
            <div><h2>Artist Name</h2>
            <input type="text" class="input-box" id="artistCriteria" placeholder="Enter artist name">
            </div>
            
            <div><h2>Category</h2>
            <input type="text" class="input-box" id="genreCriteria" placeholder="Enter category (e.g. Rock)">
            </div>

            <div><h2>Date</h2>
            <input type="date" class="input-box" id="dateCriteria" >
            </div>

            <div><h2>Organized by</h2>
            <input type="text" class="input-box" id="unameCriteria" placeholder="Enter Username" >
            </div>
    </div>
    <div class = "bottom-arrow" id="filterBoxArrow"></div>
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
                 echo '<button class="notifbtn"><img src="assets/bell.png" alt="Notifications" onclick="notifyme()"></button>
                    <div class="notifications" id="notifs">
                        <div class="notification-content" id="notBox">
                            
                        </div>

                    </div>';
                }?>

                <div>      
                    <button id="logoutBtn" type="button" class="logoutbtn" onclick="logout()" title="Sign out from <?php echo $_SESSION['uname'];?>">
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

                <h1><span class="waving"> Browse among various concerts</span></h1>

                <div class="concert-container">
                    <ul class="concert-list">
                        <?php

                        $rest_request = "http://localhost:80/api/concerts";
                        $client = curl_init($rest_request);
                        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($client);
                        curl_close($client);
                        $result = json_decode($response,true);

                        if(count($result) > 0 ){
                            foreach($result as $row){
                                echo '<li class="concert-box" cid="'.$row['_id'].'" title="' .$row['title']. '" artist="'.$row['artistname'].'" genre="'.$row['category'].'" organizer="'.getUnameByID($row['organizer'],$con)['email'].'" date="'.$row['date'].'">';
                                echo '<div><h1>\'\'' . $row['title'] . '\'\'</h1></div>';
                                echo '<div><h2>Artists: ' . $row['artistname'] . '</h2></div>';
                                echo '<div><h2>Category: ' . $row['category'] . '</h2></div>';
                                echo '<div><p>Date: ' . $row['date'] . '<br>By: ' . getUnameByID($row['organizer'],$con)['email']. '</p></div>';
                                $class = $func = "";

                                if(isFave($row['_id'])){
                                    $class = "faved";
                                    $func = "removeFave(".$row['_id'].")";
                                }else{
                                    $func = "addFave(".$row['_id'].")";
                                }
                                echo '<div><button class="favorite-button unfaved '.$class.'" id="btnconcert'. $row['_id'] .'" onclick="'.$func.'"><img src="" alt="fave" id="imgconcert'. $row['_id'] .'"></button></div>';

                                if(availableForSubscriptions($row['_id'])){
                                    $subclass = $subfunc = "";
                                    if(isSubscribed($row['_id'],$con)){
                                        $subclass = "subscribed";
                                        $subfunc = "unsubscribe(".$row['_id'].")";
                                    }else{
                                        $subfunc = "subscribe(".$row['_id'].")";
                                    }
                                    echo '<div><button class="subscribe-button unsubscribed '.$subclass.'" id="subConcert'.$row['_id'].'" onclick="'.$subfunc.'"><img src="" alt="subbtn"></button><div>';
                                }

                                echo '</li>';
                            }
                            
                        }else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                        ?>
                    </ul>

                </div>

                
                <div class="divider"> 
                </div>
                
            </div>
    </div>

   
</body>