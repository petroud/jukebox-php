<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_admin();
    $fname = $lname = $email = $role = $username = "";
    $name_err = $email_err = $empty_err = $role_err= false;

// Processing form data when form is submitted
if(isset($_POST['id']) && !empty($_POST['id'])){
    // Get hidden input value
    $id = $_POST['id'];
    
    // Validate name
    $input_fname = trim($_POST["fname"]);
    $input_lname = trim($_POST["lname"]);

    if(empty($input_fname) || empty($input_lname)){
        $empty_err = true;
    } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))) || !filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = true;
    } else{
        $q_fname = $input_fname;
        $q_lname = $input_lname;
    }
    
    // Validate email address
    $input_address = trim($_POST["email"]);
    if(empty($input_address)){
        $empty_err = true;
    } elseif(filter_var($input_address, FILTER_VALIDATE_EMAIL)){
        $q_email = $input_address;
    } else{
        $email_err = true;
    }

    // Validate role
    $input_role = $_POST["role_select"];
    if(empty($input_role)){
      $empty_err = true;
    } elseif($input_role==="ADMIN" or $input_role==="ORGANIZER" or $input_role === "USER"){
        $q_role = $input_role;
    } else{
        $role_err = true;
    }
    
    // Check input errors before inserting in database
    if(!$email_err && !$name_err && !$empty_err){
        // Prepare an update statement
        $sql = "UPDATE users SET name='$q_fname', surname='$q_lname', email='$q_email', role='$q_role' WHERE id='$id'";
        mysqli_query($con,$sql);
        header('Location: ../administration.php');
    }
    
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET['id']) && !empty(trim($_GET['id']))){
        $user_data = getDataByID($_GET['id'],$con);
        if($user_data){
            $fname = $user_data['name'];
            $lname = $user_data['surname'];
            $username = $user_data['username'];
            $email = $user_data['email'];
            $role = $user_data['role'];
        }
    }
}

function refillData($con){
    if(isset($_GET['id']) && !empty(trim($_GET['id']))){
        $user_data = getDataByID($_GET['id'],$con);
        if($user_data){
            $fname = $user_data['name'];
            $lname = $user_data['surname'];
            $username = $user_data['username'];
            $email = $user_data['email'];
            $role = $user_data['role'];
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JBox | Edit User Info</title>
    <link rel="shortcut icon" type="image/png" href="../assets/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/tools.css">
    <script >
        window.onload = function(){
  
            document.getElementById("logoutBtnDeep").onclick = function(){
                location.href = "../logout.php";
            }
        }
    </script>
    <style>
        body {
          background-image: url('../cdn/background.jpg');
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
                  <a href="../index.php"><img src="../cdn/logo.png"></a>
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
                                echo '<a href="../administration.php">User Catalog Tools</a>';
                            }elseif($_SESSION['user_role'] === "ORGANIZER"){
                                echo '<a href="../organizer.php">Organizer Tools</a>';
                            }elseif($_SESSION['user_role'] === "USER"){
                                echo '<a href="../concerts.php">Concerts</a>';
                                echo '<a href="../favorites.php">Favorites</a>';
                            }else{
                                echo 'Internal Error';
                                die;
                            }
                        ?>

                         <a href="mailto:admin@jukebox.com">Report a problem</a>
                        
                     </div>
                </div>
                <div>      
                    <button id="logoutBtnDeep" type="button" class="logoutbtn" title="Sign out from <?php echo $_SESSION['uname'];?>">
                        <img src="../assets/logout.png" alt="Logout">
                    </button>
                </div>
                <div>
                  <span> <img src="../assets/user.png" alt="User icon" class = "userico">
                   <p class="userinfo">
                       <?php 
                            printf("%s %s (%s)",$_SESSION['last_name'],$_SESSION['first_name'], $_SESSION['user_role']);
                       ?>
                   </p>
                    </span>
                </div>

            </div>

            <div class="content">
                <h1><span>Edit User Information</span></h1>
                <form method="post">

                    <input name = "fname" type="text" class = "input-box" placeholder= "First Name"
                    value = <?php  
                            if(isset($_POST['fname'])) {
                                echo $_POST['fname'];
                            }else{
                                echo $fname;
                            }
                            ?>>
                    <input name = "lname" type="text" class = "input-box" placeholder= "Last Name" 
                    value = <?php 
                            if(isset($_POST['lname'])) {
                                echo $_POST['lname'];
                            }else{
                                echo $lname;
                            }?>>
                    <input name = "username" type="text" class = "input-box" placeholder= "Username"
                    value = <?php 
                            if(isset($_POST['username'])) {
                                echo $_POST['username'];
                            }else{
                                echo $username;
                            }?> readonly>
                    <input name = "email" type="text" class = "input-box" placeholder= "Email"
                    value = <?php 
                            if(isset($_POST['email'])) {
                                echo $_POST['email'];
                            }else{
                                echo $email;
                            }?>>

                    <select name="role_select" id="role" class = "input-box styleselect">
                            <option value="ADMIN" <?php if($role == "ADMIN"){echo 'selected';}
                                                        elseif(isset($_POST['role_select']) && $_POST['role_select']==="ADMIN"){
                                                        echo 'selected';}?>>Admin</option>
                            <option value="ORGANIZER" <?php if($role == "ORGANIZER"){echo 'selected';}
                                                        elseif(isset($_POST['role_select']) && $_POST['role_select']==="ORGANIZER"){
                                                        echo 'selected';}?>>Organizer</option>
                            <option value="USER" <?php if($role == "USER"){echo 'selected';}
                                                        elseif(isset($_POST['role_select']) && $_POST['role_select']==="USER"){
                                                        echo 'selected';}?>>User</option>
                    </select><br><br>
                
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                    <input type="submit" class="button" value="Submit">
                    <a href="../administration.php" class="button btn-2">Cancel</a>
                    <?php
                            if($email_err){
                                echo '<p class="error-msg"><span> Please use a valid email address </span></p>';
                                refillData($con);
                            }
                            if($empty_err){
                                echo '<p class="error-msg"><span> Please fill in all required fields</span></p>';
                                refillData($con);
                            }
                            if($name_err){
                                echo '<p class="error-msg"><span> Please provide a valid name </span></p>';
                                refillData($con);
                            }
                            if($role_err){
                                echo '<p class="error-msg"><span> Plase provide a valid role type</span></p>';
                                refillData($con);
                            }
                        ?>
                </form>
            </div>  
            
    </div>

</body>
</html>