<?php

    function getUserInfoByEmail($email,$con){
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    function associateUserIDs($email,$keyrockID,$con){
        $query = "INSERT INTO users(keyrock_id,confirmed,email) values('$keyrockID',0,'$email')";
        mysqli_query($con,$query);
    }

    function toggleUserAuth($id,$con){
        $query = "UPDATE user SET confirmed = NOT confirmed WHERE id='$id'";
        mysqli_query($con,$query);
    }

    function disassociateUserIDs($id,$con){
        $query = "DELETE * FROM users WHERE id = '$id'";
        mysqli_query($con,$query);
    }

?>