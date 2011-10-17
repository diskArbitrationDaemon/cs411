<?php
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

    $login_query = "SELECT * FROM " . $loginTable . " WHERE Username='$username' AND Password='$password'";
    $login_result = mysql_query($login_query);
    $rows = mysql_num_rows($login_result); 
    if (!$rows){
        die ("Login error");
    }
    print ($login_result."<br>"."rows: ".$rows."<br>");
    print ("LOGIN SUCCESS!");

?>
