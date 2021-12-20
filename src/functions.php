<?php
include("connection.php");

function check_login(){
    if(isset($_SESSION['user_id'])){
      //do nothing
    }else{
        //redirect to login
        header("Location: /index.php");
        die;
    }
}

function already_login(){

    if(isset($_SESSION['user_id'])){
        header("Location: welcome.php");
    }else{
        //do nothing, stay at login
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