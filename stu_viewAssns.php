<?php

	include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
    
    $query = "SELECT * FROM assignment, course, takes  WHERE
    assignment.CourseID = course.CourseID AND
    takes.CourseID = course.CourseID AND
    takes.StudentID = '$_SESSION[username]' AND DueTime >= NOW() ";
    
    
    $result = mysql_query($query);
    if (mysql_errno()) die ("Invalid course or assignment parameter"); 
    if (mysql_num_rows($result)){

        print("<table border=0>");
        print("<br><br>\n");
        print("Assignments:");
        print("<tr><td height=50></td>");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=50>");
            print("</td><td>");
            print("<a href=\"stu_assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>");
            print("</tr><td>");
        }

        print("</table>");

    } else {
				print("<br><br>\n");
	    	    print("No assignments.");
    }
?>