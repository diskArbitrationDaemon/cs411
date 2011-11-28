<?php

    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
	
    $query = "SELECT * FROM Assignment, Course, Teaches  WHERE
    Assignment.CourseID = Course.CourseID AND
    Teaches.CourseID = Course.CourseID AND
    Teaches.InstructorID = '$_SESSION[username]'";
    
    $result = mysql_query($query);
    if (mysql_errno()) die ("Invalid course or assignment parameter"); 
    if (mysql_num_rows($result)){

        print("<table border=0>"); 
        print("<tr><td height=50></td>");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=50>");
            print("</td><td>");
            print("<a href=\"instr_assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>");
            print("</td><td width=80></td><td>");
            print("<input type=button value=Edit OnClick=\"window.location.href=
            	'instr_assignment.html?edit=true&AssnID=$row[AssnID]'\">");
            print("</td><td width=80></td><td>");
            print("<input type=button value=\"Automark\" OnClick=\"window.location.href=
            	'instr_automark_execute.html?AssnID=$row[AssnID]'\">");
            print("</td><td width=80></td><td>");
            print("<input type=button value=\"Automark Settings\" OnClick=\"window.location.href=
            	'instr_automark_display.php?AssnID=$row[AssnID]'\">");
            print("</td></tr>");
            
        }

        print("</table>");

    } else {

        print("This instructor does not currently have any registered assignments.");
    }
?>
