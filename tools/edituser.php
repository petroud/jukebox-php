<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    include("../user_database.php");

    check_login();
    check_admin();
    $fname = $lname = $role= "";

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData,true);

    $dataArr = $data;

    $uid = $dataArr['uid'];
    $fname = $dataArr['fname'];
    $lname = $dataArr['lname'];
    $role = $dataArr['role'];


    if(isset($uid) && !empty($uid)){
        // Get hidden input value
        $id = $uid;
        
        // Validate name
        $input_fname = trim($fname);
        $input_lname = trim($lname);
    
        if(empty($input_fname) || empty($input_lname)){
            echo json_encode(["response"=>"Please fill in all fields"]);
            die;
        } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))) || !filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            echo json_encode(["response"=>"Please provide a valid name"]);
            die;
        } else{
            $q_fname = $input_fname;
            $q_lname = $input_lname;
        }
    
        // Validate role
        $input_role = $role;
        if(empty($input_role)){
            echo "Please fill in all fields";
            die;
        } elseif($input_role==="ADMIN" or $input_role==="ORGANIZER" or $input_role === "USER"){
            $q_role = $input_role;
        } else{
            echo json_encode(["response"=>"Please provide a valid role"]);
            die;
        }
        
    
        // Prepare an update statement
        $data = array("user"=>array(
            'description' => $q_fname.' '.$q_lname,
            'website' => $q_role
        ));
    
        $reqData = json_encode($data);
        updateUser($id,$reqData,$_SESSION['token'],$con);
        echo json_encode(["response"=>"Successful Update"]);
        die;
    }

?>