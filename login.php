<?php
    include 'login_header.php';
    $mySqlHost = "localhost";
    $mySqlUser = "login_auth";
    $mySqlPass = "hello123";

    $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
    
    $username = mysql_real_escape_string($_POST["username"]);
    $password = mysql_real_escape_string($_POST["password"]);
    //encrypt the password using md5 to match database
    $encryptedPassword = md5 ($password);

    $loginDb = "assignments_users_uiuc";
    $loginTable = "users";

    mysql_select_db($loginDb) or die("Can not connect to login table.");

    $login_query = "SELECT * FROM " . $loginTable . " WHERE Username='$username' AND Password='$encryptedPassword'";
    print($login_query);
    $login_result = mysql_query($login_query);
    $rows = mysql_num_rows($login_result);
    $referrer = $_SERVER["HTTP_REFERER"];
    $referrer = substr($_SERVER["HTTP_REFERER"], 0,  (strpos($_SERVER["HTTP_REFERER"], "?")));
    //remove any GET values

    if (!$rows){
        //send user back to login page
        print("<html> <head>");
        print("<meta http-equiv=\"REFRESH\" content=\"3;url=". $referrer . "?fail=1\"></HEAD>");
        print("<BODY></BODY></HTML>");
    } else {
        $_SESSION['username'] = $username;
        $login_row = mysql_fetch_array($login_result);
        $userType = $login_row['UserType'];
        
        print("userType = " . $userType);
        print("<br>");

        //depending on which type of user (instructor, admin, student)
    }



?>
