<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
    check_organizer();
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Users Console</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/organizer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="/src/welcome.js"></script>

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        body {
          background-image: url('cdn/background.jpg');
          background-repeat: no-repeat;
          background-size: 100% 100%;
          background-attachment: fixed;
          font-family: "Roboto",sans-serif;
          font-family: 'Work Sans', sans-serif;
          overflow:auto;
        }
        </style>
     <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
                <div><h1><span>My Concerts and Events</span></h1></div>

                    <?php
                    // Include config file
                    require_once "connection.php";
                    $uid = $_SESSION['user_id'];
                    $sql = "SELECT * FROM concerts WHERE organizer = $uid";

                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="content-table">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date</th>";
                                        echo "<th>Artists</th>";
                                        echo "<th>Category</th>";
                                        echo "<th>Action</th>";

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['artistname'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="/tools/confedit.php?id='. $row['id'] .'"><img class = "conf-ico" src="/assets/activate.png" alt="change confirmed"></a>';
                                            echo '<a href="/tools/update.php?id='. $row['id'] .'"><img class = "conf-ico" src="/assets/editing.png" alt="change confirmed"></a>';
                                            echo '<a href="/tools/userdel.php?id='. $row['id'] .'"><img class = "conf-ico" src="/assets/bin.png" alt="change confirmed"></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            <div class="divider">

            </div>
    </div>
</body>