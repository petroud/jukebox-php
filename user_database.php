<?php

    function getUsers($token){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:3005/v1/users");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Auth-token:".$token
        ));
        curl_close($ch);

        $response = curl_exec($ch);
        $users = json_decode($response,true);
        
        return $users;

    }

    function getUserInfoByEmail($email,$con){
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    function getKeyrockIDByAppID($id,$con){
        $query = "SELECT keyrock_id FROM users WHERE id='$id'";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data['keyrock_id'];
        }
    }

    function appInfoByKeyrockID($id,$con){
        $query = "SELECT id, confirmed FROM users WHERE keyrock_id='$id'";
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

    function toggleUserStatus($id,$con){
        $query = "UPDATE users SET confirmed = NOT confirmed WHERE id='$id'";
        mysqli_query($con,$query);
    }

    function disassociateUserIDs($id,$con){
        $query = "DELETE FROM users WHERE id = $id";
        mysqli_query($con,$query);
    }

    function deleteUser($id,$token,$con){
        $keyrockID = getKeyrockIDByAppID($id,$con);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:3005/v1/users/".$keyrockID);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Auth-token:".$token));
        curl_exec($ch);
        curl_close($ch);
        disassociateUserIDs($id,$con);
    }

    function updateUser($id,$data,$token,$con){
        $keyrockID = getKeyrockIDByAppID($id,$con);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://192.168.1.11:3005/v1/users/".$keyrockID);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "X-Auth-token:".$token
            ));

        $response = curl_exec($ch);
        curl_close($ch);
    }

?>