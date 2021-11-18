<?php
    session_start();
    include("../functions.php");
    include("../connection.php");
    check_login($con);
    check_organizer();
    $title = $artist = $genre = $date= "";


    if(isset($_POST['cid']) && !empty($_POST['cid'])){
        // Get hidden input value
        $cid = $_POST['cid'];
        $uid = $_SESSION['user_id'];
        
        // Validate name
        $input_title = trim($_POST["title"]);
        $input_artist = trim($_POST["artist"]);
        $input_genre = trim($_POST["genre"]);
        $input_date = ($_POST["date"]);
    
        if(empty($input_title) || empty($input_artist) || empty($input_genre) || empty($input_date)){
            echo "Please fill in all fields";
            die;
        } else{
            $q_title = $input_title;
            $q_artist = $input_artist;
            $q_genre = $input_genre;
            $q_date = $input_date;
        }
            
        $authQuery = "SELECT * FROM concerts WHERE id=$cid AND organizer=$uid";
        $authResult = mysqli_query($con,$authQuery);
        if($authResult){
            $sql = "UPDATE concerts SET title='$q_title', artistname='$q_artist', category='$q_genre', date='$q_date' WHERE id=$cid ";
            mysqli_query($con,$sql);
        }else{
            die;
        }
        echo "Successful Update";
        die;
    }

?>