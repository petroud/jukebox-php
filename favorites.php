<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
    check_user();

    function isFave($cid,$con){
        $uid = $_SESSION['user_id'];
        $checkQuery = "SELECT * FROM favorites WHERE user_id = $uid AND concert_id = $cid";
        $result = mysqli_query($con, $checkQuery);
        
        if($result && mysqli_num_rows($result)===1){
            return true;
        }else{
            return false;
        }
    }     

    function decide_Color($id,$con){
        if(isFave($id,$con)){
            return 'style="background-color: #d62b2b;"';
        }else{
            // return nothing
        }
    }
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Favorites </title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/concerts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="/src/welcome.js"></script>

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
                        $uid = $_SESSION['user_id'];
                        $query = "SELECT * FROM (SELECT * FROM favorites WHERE user_id = '$uid') as faves LEFT JOIN concerts ON faves.concert_id =concerts.id";
                        if($result = mysqli_query($con, $query)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    echo '<li class="concert-box">';
                                    echo '<div><h1>\'\'' . $row['title'] . '\'\'</h1></div>';
                                    echo '<div><h2>Artists: ' . $row['artistname'] . '</h2></div>';
                                    echo '<div><h2>Genres: ' . $row['category'] . '</h2></div>';
                                    echo '<div><p>Date: ' . $row['date'] . '<br>By: ' . getUnameByID($row['organizer'],$con)['username'] . '</p></div>';
                                    echo '<div><a href="/tools/fave.php?id=' . $row['id'] . '&src=favorites"><button class="favorite-button"'. decide_Color($row['id'],$con) .'><img src="/assets/heart.png" alt="fave"></button></a></div>';
                                    echo '</li>';
                        }
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