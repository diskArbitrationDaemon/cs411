<?php
    session_start(); 

    include ('includes/login_header.php');

    $mySqlHost = "localhost";
    $mySqlUser = "menu";
    $mySqlPass = "hello123";

    $mysqlConnection = mysql_connect($mySqlHost, $mySqlUser, $mySqlPass) or die("Can not connect to DB. " . mysql_error());
    mysql_select_db("assignments_users_uiuc");

    $query = "SELECT UserType FROM Users WHERE Username='".$_SESSION['username']."'";
    $result = mysql_query($query);
	if (mysql_errno()) die (mysql_error());
    $row = mysql_fetch_array($result);
    $userType = $row['UserType'];

    print("<table border=\"0\">");
    if ($userType | ADMINISTRATOR){
        
    }

    if ($userType | INSTRUCTOR){
        
        print("<tr>");
        print("<td>");
        print("<a href=\"instructor.html\" target=\"_parent\">Instructor overview</a>");
        print("</td>");
        print("</tr>");
        print("<tr>");
        print("<td>");
        print("<a href=\"instr_viewCourses.html\" target=\"_parent\">View Courses</a>");
        print("</td>");
        print("</tr>");
        print("<tr>");
        print("<td>");
        print("<a href=\"instr_viewAssns.html\" target=\"_parent\">View Assignments</a>");
        print("</td>");
        print("</tr>");
        print("<tr>");
        print("<td>");
        print("<a href=\"instr_assignment.html?create=true\" target=\"_parent\">Create New Assignment</a>");
        print("</td>");
        print("</tr>");

        
        
    }

    if ($userType | STUDENT){

    }

?>
