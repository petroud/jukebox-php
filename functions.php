<?php

function check_login($con){

    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id= '$id' limit 1";
        
        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

    }else{
        //redirect to login
        header("Location: /index.php");
        die;
    }
}

function already_login($con){

    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id= '$id' limit 1";
        
        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
        //if already logged-in dont login or sign up again go straight to welcome page
        //this is useful in case user presses back from welcome page and tries to login again
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
