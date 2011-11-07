<?php
    session_start(); 

    include ('includes/login_header.php');

    $mySqlHost = "localhost";
    $mySqlUser = "menu";
    $mySqlPass = "hello123";

    $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
    mysql_select_db("assignments_uiuc_users");

    $query = "SELECT UserType FROM Users WHERE Username='".$_SESSION['username']."'";
    $result = mysql_query($query);

    $row = mysql_fetch_array($result);
    $userType = $row['UserType'];

    print("<table border=\"0\">");
    if ($userType | ADMINISTRATOR){
        
    }

    if ($userType | INSTRUCTOR){
        print("<tr>");
        print("<td>");
        print("<a href=\"instr_viewCourses.html\">View Courses</a>");
        print("</td>");
        print("</tr>");
        
    }

    if ($userType | STUDENT){

    }

?>
