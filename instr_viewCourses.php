<?php

    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');

    //select courses taught by this instructor
    $query = "SELECT courseName, SemesterName, teaches.courseID
    FROM  `teaches` , course
    WHERE teaches.courseID = course.CourseID
    AND teaches.instructorID = '$_SESSION[username]'
    ORDER BY  `teaches`.`CourseID` DESC";

    $result = mysql_query($query);
    
    if (mysql_num_rows($result)){

        print("<table border=0>");
        print("<tr><td height=50></td>");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=50>");
            print("</td><td>");
            print("<a href=\"instr_course.html?CourseID=$row[courseID]\">$row[courseName] $row[SemesterName]</a>");
            print("</tr><td>");
        }

        print("</table>");

    } else {

        print("This instructor does not currently have a registered course.");
    }
?>
