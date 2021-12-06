<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_admin();
    $fname = $lname = $email = $role= "";

    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData,true);

    $dataArr = $data;

    $uid = $dataArr['uid'];
    $fname = $dataArr['fname'];
    $lname = $dataArr['lname'];
    $email = $dataArr['email'];
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
        
        // Validate email address
        $input_address = trim($email);
        if(empty($input_address)){
            echo json_encode(["response"=>"Please fill in all fields"]);
            die;
        } elseif(filter_var($input_address, FILTER_VALIDATE_EMAIL)){
            $q_email = $input_address;
        } else{
            echo json_encode(["response"=>"Please provide a valid email address"]);
            die;
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
        $data = array(
            'fname' => $q_fname,
            'lname' => $q_lname,
            'email' => $q_email,
            'role' => $q_role
        );
    
        $reqData = json_encode($data);
        
        $rest_request = "http://localhost:80/api/user/update/".$uid;
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL,$rest_request);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $reqData);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);

        echo json_encode(["response"=>"Successful Update"]);
        die;
    
    }

?>