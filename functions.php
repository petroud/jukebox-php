<?php
include("connection.php");

function check_login($con){

    if(isset($_SESSION['user_id'])){
      //do nothing
    }else{
        //redirect to login
        header("Location: /index.php");
        die;
    }
}

function already_login($con){

    if(isset($_SESSION['user_id'])){
        header("Location: welcome.php");
    }else{
        //do nothing, stay at login
    }
}

function getDataByID($id,$con){
    check_admin();
    $query = "SELECT name,surname,username,email,role FROM users WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    }
}

function getUnameByID($id,$con){
    check_login($con);
    check_user();
    $query = "SELECT email FROM users WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0){
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;
    }
}

function check_admin(){

    if(isset($_SESSION['user_id'])){
           
        if($_SESSION['user_role'] === "ADMIN"){
            //do nothing
        }else{
            header("Location: /authfailed.php");
        }
        
    }else{
        header("Location: /index.php");
    }
}

function check_user(){

    if(isset($_SESSION['user_id'])){
           
        if($_SESSION['user_role'] === "USER"){
            //do nothing
        }else{
            header("Location: /authfailed.php");
        }
        
    }else{
        header("Location: /index.php");
    }
}


function check_organizer(){

    if(isset($_SESSION['user_id'])){
           
        if($_SESSION['user_role'] === "ORGANIZER"){
            //do nothing
        }else{
            header("Location: /authfailed.php");
        }
        
    }else{
        header("Location: /index.php");
    }
}