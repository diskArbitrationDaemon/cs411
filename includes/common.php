<?
    $mySqlHost = "localhost";
    $mySqlUser = "login_auth";
    $mySqlPass = "hello123";

    $redirect_pauseTime = 3;
    $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
?>


