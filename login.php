<?php
    session_start();
    include("parser.php");
    include("databases.php");
    include("connection.php");
    $activ_error = $auth_error = $data_form_error = false;

    //Authenticate 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        if(!empty($username) && !empty($password)){
            //Acquire X-Subject Token from keyrock for this session using credentials given by client and acquire info if user exists and is authenticated
            $user_creds = '{
                "name":"'.$username.'",
                "password":"'.$password.'"}';

            $cc = curl_init();

            //Build request to be sent to IDM-Keyrock service
            curl_setopt($cc, CURLOPT_URL, "http://192.168.1.11:3005/v1/auth/tokens");
            curl_setopt($cc, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($cc, CURLOPT_HEADER, 1);
            curl_setopt($cc, CURLOPT_POST, TRUE);
            curl_setopt($cc, CURLOPT_POSTFIELDS, $user_creds);
            curl_setopt($cc, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            
            //Execute request and check if authentication is successfull by checking if a new token is generated
            $response = curl_exec($cc);
            $header_size = curl_getinfo($cc, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $hdrArray = http_parse_headers($header);
            curl_close($cc);

            $xToken="";
            ini_set('display_errors',0);
            try{
                $xToken = $hdrArray['X-Subject-Token'];
            }catch(Exception $ex){
                $xToken="";
            }

            if(empty($xToken)){
                //Error in authentication
                $auth_error=true;
            }else{
                //Token was generated, authentication successfull, request user data and assign the session variables. Bring up the welcome page

                //Get user keyrock ID and app ID + confirmed status from the ID correllation Database
                $userAppInfo = getUserInfoByEmail($username,$con);          
                if($userAppInfo['confirmed']==0){
                   $activ_error = true;
                }else{

                    //Build request to be sent to IDM-Keyrock service for reading the user info
                    $curlClient = curl_init();
                    curl_setopt($curlClient, CURLOPT_URL, "http://192.168.1.11:3005/v1/users/".$userAppInfo['keyrock_id']);
                    curl_setopt($curlClient, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($curlClient, CURLOPT_HTTPHEADER, array("X-Auth-Token: ".$xToken));
                    $answerIDM = curl_exec($curlClient);
                    curl_close($curlClient);

                    $userInfo = json_decode($answerIDM,true);

                    //Assign required session variables for a achieving functionality later
                    $_SESSION['token'] = $xToken;
                    $_SESSION['uname'] = $userInfo['user']['username'];
                    $_SESSION['email'] = $userInfo['user']['email'];
                    $_SESSION['keyrock_id'] = $userInfo['user']['id'];
                
                    $_SESSION['user_id'] = $userAppInfo['id'];
                    $_SESSION['confirmed'] = $userAppInfo['confirmed'];

                    $fullname = $userInfo['user']['description'];
                    $sliced = explode(" ",$fullname);
                    $_SESSION['first_name'] = $sliced[0];
                    $_SESSION['last_name'] = $sliced[1];

                    $_SESSION['user_role'] = $userInfo['user']['website'];

                    header("Location: welcome.php");
                }
            }
        }else{
            $data_form_error = true;
        }
    }
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Jukebox | Log in</title>
    <link rel="shortcut icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="./src/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Work+Sans:ital,wght@0,100;0,200;0,400;0,500;0,600;1,100&display=swap" rel="stylesheet">

    <script src="./src/main.js"></script>

    <style>
        body {
          background-image: url('cdn/background.jpg');
          background-repeat: no-repeat;
          background-size: 100% 100%;
          background-attachment: fixed;
          font-family: "Roboto",sans-serif;
          font-family: 'Work Sans', sans-serif;
        }
        </style>
</head>

<body>
    <div class="banner">
            <div class="navbar">
                <div class="logo">
                  <a href="index.php"><img src="cdn/logo.png"></a>
                </div>
                <div class="menu-icons">
                    <a href="signup.php"><img src="assets/signup.png" alt="Sing Up"></a>
                    <a href="mailto:admin@jukebox.com"><img src="assets/alert.png" alt="Report a problem"></a>
                </div>
            </div>

            <div class="content">

                <div>
                    <form method = "POST">
                        <h1 class="waving-text">Please enter your credentials</h1>
                        <input name = "uname" type="text" class = "input-box" placeholder= "E-Mail">
                        <input name = "pass" type="password" class = "input-box" placeholder= "Password"><br><br>
                        <input type="submit" class = "waving button" value="LOGIN"><br><br>
                        <?php
                            if($data_form_error){
                                echo '<p class="error-msg"><span> Please fill in all required fields</span></p>';
                            }
                            if($auth_error){
                                echo '<p class="error-msg"><span> Wrong username or password. Try again </span></p>';
                            }
                            if($activ_error){
                                echo '<p class="error-msg"><span> Your account is not yet activated. Try again later </span></p>';
                            }
                        ?>
                        <a href="signup.php" class = "sign-up-ref"> Don't have an account? Sign up </a>
                    </form>                   
                   
                </div>
                <div>
                    <img src="assets/favicon.png" class="favi">
                    <h5 class = "favitext">© 2021 JUKEBOX</h5>
                </div>
                <div class="caption">
                    <h4>
                        -Live Aid 13/7/1985<br>
                         Queen performing 'Bohemian Rhapsody'
                    </h4>
                </div>
            </div>
    </div>
</body>