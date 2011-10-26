<?php
    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
    session_start();
    $courseTable = "Course";
    $assignmentTable = "Assignment";
    $instructorTable = "Instructor";

    $courseID= htmlspecialchars($_GET['CourseID']);
    if (htmlspecialchars($_GET['q'] == "GetCourses")){
        $query = "SELECT * FROM $courseTable WHERE CourseID = $courseID";
        //only returns 1 row or our database has primary key issues
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        if (!empty($row['CourseName'])){
            print ("<h3>".$row['CourseName']." ".$row['SemesterName']."</h3>");
            print ("There are ".$row['NumStudents']." students enrolled.<br>\n");
        } else {
            print "<h3> Invalid course selected. </h3>";
        }

    } else  if (htmlspecialchars($_GET['q'] == "GetAssignments")){
        $query = "SELECT * FROM $assignmentTable WHERE CourseID = $courseID";
        $result = mysql_query($query);
        print("<table border=0 width=800>\n");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=50%>\n");
            print("$row[AssnName]");
            print("</td><td width=50%>");
            print("$row[DueTime]");
            print("</td></tr>");
        }
        print("</table>");
    } else if (htmlspecialchars($_GET['q'] == "GetInstructors")){
        $query = "SELECT * FROM `Teaches`, Instructor WHERE 
        Teaches.CourseID=1 AND
        Teaches.NetID=Instructor.NetID";
        $result = mysql_query($query);
        print("<table border=0 width=800>\n");
        while ($row = mysql_fetch_array($result)){
            print("<tr><td width=20%>");
            print("$row[FirstName] ");
            print("$row[LastName]");
            print("</td><td width=20%>");
            print("$row[PhoneNumber]");
            print("</td><td width=40%>");
            print("$row[Email]");
            print("</td>");
        }
        print("</table>");


    }
?>
