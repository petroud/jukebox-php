<?php
session_start();

    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
    check_admin();
?>


<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Users Console</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/users.css">
    <link rel="stylesheet" href="/src/tablesorter.css">
    <link rel="stylesheet" href="/src/editor.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script src="/src/welcome.js"></script>
    <script src="/src/tablesort.js"></script>
    <script src="/src/users.js"></script>
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
</head>



<body>
    <div class="overlay" id="editorback"> 
        <div class="editor-box" id="editor-box">
            <h1><span class="waving">Edit User Information</span></h1>
                    <form method="post" class="editor-form">
                        <input name = "fname" type="text" class = "input-box" placeholder= "First Name" id="edit_fname">
                        <input name = "lname" type="text" class = "input-box" placeholder= "Last Name" id="edit_lname" >
                        <input name = "username" type="text" class = "input-box" placeholder= "Username" id="edit_uname" readonly>
                        <input name = "email" type="text" class = "input-box" placeholder= "Email" id="edit_mail">
                        <input type="hidden" name="id" value="" id="key_field">
                        <select name="role_select" class = "input-box styleselect" id="edit_role">
                                <option value="ADMIN">Admin</option>
                                <option value="ORGANIZER">Organizer</option>
                                <option value="USER">User</option>
                        </select><br><br>
                        <button type="button" class="button" onclick="submitEdits()">Submit</button>
                        <button type="button" class="button btn-2 repos" onclick="closeEditor()" id="exitbtn">Cancel</button>
                        <div class="resultBox" id="resBox"><p class="result-msg" id="resMsg"></p></div>
                    </form>
        </div>
    </div> 
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
                <div><h1><span>Users of Jukebox |  Administrator Console</span></h1></div>

                    <?php
                    // Include config file
                    require_once "connection.php";
                    
                    $sql = "SELECT * FROM users";
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="content-table table-sortable">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>First Name</th>";
                                        echo "<th>Last Name</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Role</th>";
                                        echo "<th>Confirmed</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr id=row_".$row['id'].">";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['surname'] . "</td>";
                                        echo "<td id=uname_".$row['id'].">". $row['username'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        if($row['confirmed'] == 1){
                                            echo "<td id=status_".$row['id']." style=\"color:green;\">" . 'Confirmed' . "</td>";
                                        }else{
                                            echo "<td id=status_".$row['id']." style=\"color:red;\">"  . 'Deactivated' . "</td>";
                                        }
                                        echo "<td>";
                                            echo '<a href="javascript:statusUser('.$row['id'].');"><img class = "conf-ico" src="/assets/activate.png" alt="change confirmed"></a>';
                                            echo '<a href="javascript:editUser('. $row['id'] .');"><img class = "conf-ico" src="/assets/editing.png" alt="change confirmed"></a>';
                                            echo '<a href="javascript:delUser('.$row['id'].');"><img class = "conf-ico" src="/assets/bin.png" alt="change confirmed"></a>';
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