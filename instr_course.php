<?php
    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');

    

    session_start();
    $courseID = htmlspecialchars($_GET['CourseID']);

    //check to see if this instructor actually teaches this course. If not, error is displayed.

    $query = "SELECT * FROM Teaches as t, Instructor as i WHERE t.InstructorID = i.InstructorID AND t.InstructorID='".$_SESSION['username'] ."' AND t.CourseID='$courseID'";
    $result = mysql_query($query);

    $row = mysql_fetch_array($result);
   
    if (!empty($row['CourseID'])) {

        if (htmlspecialchars($_GET['q'] == "GetCourses")){
            $query = "SELECT * FROM $courseTable WHERE CourseID = $courseID";
            //only returns 1 row or our database has primary key issues
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            if (!empty($row['CourseName'])){
                print ("<h3>".$row['CourseName']." ".$row['SemesterName']."</h3>");
                $query = "SELECT * FROM `takes` WHERE CourseID='$courseID'";
                $result = mysql_query($query);
                print ("There are ".mysql_num_rows($result)." students enrolled.<br>\n");
            } else {
                print "<h3> Invalid course selected. </h3>";
            }

        } else  if (htmlspecialchars($_GET['q'] == "GetAssignments")){
            $query = "SELECT * FROM $assignmentTable WHERE CourseID = $courseID";
            $result = mysql_query($query);
            print("<table border=0 width=800>\n");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=50%>\n");
                print("<a href=\"instr_assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>");
                print("</td><td width=50%>");
                print("$row[DueTime]");
                print("</td></tr>");
            }
            print("</table>");
        } else if (htmlspecialchars($_GET['q'] == "GetInstrStudent")){
			$query = "SELECT S.FirstName, S.LastName, S.StudentID FROM takes as T, student as S WHERE t.CourseID='$courseID' AND
			T.StudentID=S.StudentID";
            $result = mysql_query($query);
            print("<table border=0 width=800>\n");
			print("<tr><td height=20></td></tr>");

            print("<tr><td width=20%><h4>Students</h4></td></tr>");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=20%>");
                print("$row[FirstName] ");
                print("$row[LastName]");
                print("<td width=40%>");
                print("<a href=\"instr_mark.html?StudentID=$row[StudentID]&CourseID=$courseID\">$row[StudentID]</a>");
                print("</td>");
                print("</td></tr>");
            }
            print("</table>");
            
            $query = "SELECT * FROM `Teaches`, Instructor WHERE 
            Teaches.CourseID=$courseID AND
            Teaches.InstructorID=Instructor.InstructorID";
            $result = mysql_query($query);
            print("<table border=0 width=800>\n");
            print("<tr><td height=20></td></tr>");
           
			print("<tr><td width=20%><h4>Instructors</h4></td></tr>");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=20%>");
                print("$row[FirstName] ");
                print("$row[LastName]");
                print("</td><td width=20%>");
                print("$row[PhoneNumber]");
                print("</td><td width=40%>");
                print("$row[Email]");
                print("</td></tr>");
            }
            print("</table>");


        }
    } else {
        
        if (htmlspecialchars($_GET['q'] == "GetCourses")){
            print(" You are not authorised to view this course as you are not a registered instructor. Please see the administrator for details.");
        }

    }
?>
