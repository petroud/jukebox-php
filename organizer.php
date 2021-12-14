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
    <title>Jukebox | Organizer Console</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="/src/organizer.css">
    <link rel="stylesheet" href="/src/editor.css">
    <link rel="stylesheet" href="/src/scroll.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="/src/welcome.js"></script>
    <script src="/src/organizer.js"></script>



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
        </style>
</head>



<body> 
    <div class="overlay" id="editorback"> 
        <div class="editor-box" id="editor-box">
            <h1><span class="waving" style="margin-left:-20px !important">Edit Concert Information</span></h1>
                    <form method="post" class="editor-form">
                        <p style="margin-left:90px; margin-bottom:30px; font-size:25px;" id="idEditBox"></p>
                        <input name = "title" type="text" class = "input-box" placeholder= "Concert Title" id="edit_title">
                        <input name = "artist" type="text" class = "input-box" placeholder= "Artist Name" id="edit_artist" >
                        <input name = "date" type="date" class = "input-box" placeholder= "Date" id="edit_date">
                        <input name = "genre" type="text" class = "input-box" placeholder= "Genre" id="edit_genre">
                        <input type="hidden" name="id" value="" id="key_field">
                        <button type="button" class="button" onclick="submitEdits()">Submit</button>
                        <button type="button" class="button btn-2 repos" onclick="closeEditor()" id="exitbtn">Cancel</button>
                        <div class="resultBox" id="resBox"><p class="result-msg" id="resMsg"></p></div>
                    </form>
        </div>
    </div> 

    <div class="overlay" id="adderback"> 
        <div class="editor-box" id="adder-box">
            <h1><span class="waving" style="margin-left: 30px !important">Add New Concert</span></h1>
                    <form method="post" class="editor-form">
                        <input name = "title" type="text" class = "input-box" placeholder= "Concert Title" id="new_title">
                        <input name = "artist" type="text" class = "input-box" placeholder= "Artist Name" id="new_artist" >
                        <input name = "date" type="date" class = "input-box" placeholder= "Date" id="new_date">
                        <input name = "genre" type="text" class = "input-box" placeholder= "Genre" id="new_genre">
                        <button type="button" class="button" onclick="addConcert()">Add</button>
                        <button type="button" class="button btn-2 repos" onclick="closeAdder()" id="addExitbtn">Cancel</button>
                        <div class="resultBox" id="addResBox"><p class="result-msg" id="addResMsg"></p></div>
                    </form>
        </div>
    </div> 

    <div class="overlay" id="ticketback"> 
        <div class="editor-box" style="margin-top:100px !important" id="ticket-box">
            <h1><span class="waving" style="margin-left: 5px !important">Ticket Sales Manager</span></h1>
                    <form method="post" class="editor-form">
                        <p style="margin-left:90px; margin-bottom:30px; font-size:25px;" id="idTicketBox"></p>
                        <p style="margin-left:30px; margin-bottom:0px; font-size:20px">Available From:</p>
                        <input name = "date" type="date" class = "input-box" placeholder= "Date" id="ticket_start_date">
                        <p style="margin-left:30px; margin-bottom:0px; font-size:20px">Available To:</p>
                        <input name = "date" type="date" class = "input-box" placeholder= "Date" id="ticket_end_date">
                        <input type="hidden" name="id" value="" id="concert_key_tickets">
                        <br>
                        <br>
                        <button type="button" class="button" style="width:250px !important; margin-left: 45px !important" onclick="submitTickets()">Schedule Sales</button>
                        <br>
                        <br>
                        <button type="button" class="button" style="width:250px !important; margin-left: 45px !important; background-color: #b83939 !important" onclick="outTickets()">Sold Out</button>
                        <br>
                        <br>
                        <button type="button" class="button btn-2 repos" style="margin-left:108px" onclick="closeTicketer()" id="ticketExitbtn">Cancel</button>
                        <div class="resultBox" id="ticketResBox"><p class="result-msg" id="ticketResMsg"></p></div>
                    </form>
        </div>
    </div> 

    <div class="banner" id="banner">
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

    <div class="content" id="content"> 
                <div><h1><span>My Concerts and Events</span></h1>
                    <button onclick ="newConcert()" class="add-button"><img src="/assets/plus.png" alt="Filter Concerts"></button>
                </div>
                              
            <?php
                    $uid = $_SESSION['user_id'];
                    $rest_request = "http://localhost:80/api/organizer/".$uid;
                    $client = curl_init($rest_request);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    curl_close($client);
                    $result = json_decode($response,true);

                    
                    if(count($result) > 0){
                        echo '<table class="content-table" id="concert-table">';
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
                            foreach($result as $row){
                                echo '<tr id="row_'.$row['_id'].'">';
                                    echo "<td>" . $row['_id'] . "</td>";
                                    echo '<td id="title_'.$row['_id'].'">'. $row['title'] . '</td>';
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['artistname'] . "</td>";
                                    echo "<td>" . $row['category'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="javascript:editConcert('.$row['_id'].')"><img class = "conf-ico" src="/assets/editing.png" alt="edit concert"></a>';
                                        echo '<a href="javascript:editTickets('.$row['_id'].')"><img class = "conf-ico" src="/assets/ticket.png" alt="edit concert tickets"></a>';
                                        echo '<a href="javascript:delConcert('.$row['_id'].')"><img class = "conf-ico" src="/assets/bin.png" alt="delete concert"></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    } else{
                        echo '<div><em>No records were found.</em></div>';
                    }
                ?>
                </div>
            <div class="divider">

            </div>
    </div>
</body>