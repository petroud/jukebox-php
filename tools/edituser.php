<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_admin();
    $fname = $lname = $email = $role= "";


    if(isset($_POST['uid']) && !empty($_POST['uid'])){
        // Get hidden input value
        $id = $_POST['uid'];
        
        // Validate name
        $input_fname = trim($_POST["fname"]);
        $input_lname = trim($_POST["lname"]);
    
        if(empty($input_fname) || empty($input_lname)){
            echo "Please fill in all fields";
            die;
        } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))) || !filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            echo "Please provide a valid name";
            die;
        } else{
            $q_fname = $input_fname;
            $q_lname = $input_lname;
        }
        
        // Validate email address
        $input_address = trim($_POST["email"]);
        if(empty($input_address)){
            echo "Please fill in all fields";
            die;
        } elseif(filter_var($input_address, FILTER_VALIDATE_EMAIL)){
            $q_email = $input_address;
        } else{
            echo "Please provide a valid email address";
            die;
        }
    
        // Validate role
        $input_role = $_POST["role"];
        if(empty($input_role)){
            echo "Please fill in all fields";
            die;
        } elseif($input_role==="ADMIN" or $input_role==="ORGANIZER" or $input_role === "USER"){
            $q_role = $input_role;
        } else{
            echo "Please provide a valid role";
            die;
        }
        
    
        // Prepare an update statement
        $sql = "UPDATE users SET name='$q_fname', surname='$q_lname', email='$q_email', role='$q_role' WHERE id='$id'";
        mysqli_query($con,$sql);
        echo "Successful Update";
        die;
    
    }

?>