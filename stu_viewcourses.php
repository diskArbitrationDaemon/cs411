<?php
  	include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
     
    $query = "SELECT takes.CourseID, CourseName, SemesterName
    FROM  takes , course
    WHERE takes.CourseID = course.CourseID
    AND takes.StudentID = '$_SESSION[username]'
    ORDER BY  `takes`.`CourseID` DESC";

    $result = mysql_query($query);
    
    if (mysql_num_rows($result)){

        print("<table border=0>");
        print("<tr><td height=50></td>");
        print("Courses:");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=50>");
            print("</td><td>");
            print("<a href=\"stu_course.html?CourseID=$row[CourseID]\">$row[CourseName]</a> ". "$row[SemesterName]");
            print("</tr><td>");
        }

        print("</table>");

    } else {

        print("No registered course.");
    }
?>
