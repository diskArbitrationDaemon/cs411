<?php
    include 'includes/login_header.php';
    include 'includes/common.php';
    print("<html> <head></head><body>");
    
   
    $username = mysql_real_escape_string($_POST["username"]);
    $password = mysql_real_escape_string($_POST["password"]);
    //encrypt the password using md5 to match database
    $encryptedPassword = md5 ($password);

    $loginDb = "assignments_users_uiuc";
    $loginTable = "users";

    mysql_select_db($loginDb) or die("Can not connect to login table." . mysql_error());
   
    $login_query = "SELECT * FROM " . $loginTable . " WHERE Username='$username' AND Password='$encryptedPassword'";
    //print($login_query);
    $login_result = mysql_query($login_query);
    $rows = mysql_num_rows($login_result);
    $referrer = $_SERVER["HTTP_REFERER"];
    //remove any GET values

    print("rows: $rows");
    if (!$rows){
        //send user back to login page
        print("<meta http-equiv=\"REFRESH\" content=\"". $redirect_pauseTime . ";url=login.html?fail=1\">");
    } else {
        session_start();
        $_SESSION['username'] = $username;
        $login_row = mysql_fetch_array($login_result);
        $userType = $login_row['UserType'];
    
        //different users will have different redirect pages
        if ($userType == ADMINISTRATOR){
            $url = ADMIN_PHP;
        } else if ($userType == INSTRUCTOR){
            $url = INSTRUCTOR_PHP;
        } else if ($userType == STUDENT){
            $url = STUDENT_PHP;
        } else {
            die("User type not found");
        }
    
        print("userType = " . $userType);
        print("<br>");

        print("<meta http-equiv=\"REFRESH\" content=\"" . $redirect_pauseTime ." ;url=" . $url . "\">");
       
    }

    
        print("</BODY></HTML>");

?>
