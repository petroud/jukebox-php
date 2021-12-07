<?php

    function getUserInfoByEmail($email,$con){
        $query = "SELECT * FROM users WHERE username = '$email' LIMIT 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    function associateUserIDs($email,$keyrockID,$con){
        $query = "INSERT INTO users(keyrock_id,username) values('$keyrockID','$email')";
        mysqli_query($con,$query);
    }

    function toggleUserAuth($email,$con){
        $query = "UPDATE user SET confirmed = NOT confirmed WHERE email='$email'";
        mysqli_query($con,$query);
    }

    function disassociateUserIDs($email,$con){
        $query = "DELETE * FROM users WHERE username = '$email'";
        mysqli_query($con,$query);
    }

?>