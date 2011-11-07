<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');

    

    session_start();
    $courseID= htmlspecialchars($_GET['CourseID']);

      //check to see if this student actually takes this course. If not, error is displayed.

    $query = "SELECT * FROM takes as t, student as s WHERE t.StudentID = s.StudentID AND t.StudentID='".$_SESSION['username'] ."' AND t.CourseID='$courseID'";
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
                print("<a href=\"stu_assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>");
                print("</td><td width=50%>");
                print("$row[DueTime]");
                print("</td></tr>");
            }
            print("</table>");
        } else if (htmlspecialchars($_GET['q'] == "GetInstructors")){
            $query = "SELECT * FROM `Teaches`, Instructor WHERE 
            Teaches.CourseID=1 AND
            Teaches.InstructorID=Instructor.InstructorID";
            $result = mysql_query($query);
            print("<table border=0 width=800>\n");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=30%>");
                print("Name : ");
                print("$row[FirstName] ");
                print("$row[LastName]");
                print("</td><td width=20%>");
                print("Phone Number : ");
                print("$row[PhoneNumber]");
                print("</td><td width=20%>");
                print("email : ");
                print("$row[Email]");
                print("</td>");
            }
            print("</table>");
        } else if (htmlspecialchars($_GET["q"] == "GetResults")){
    
            $query = "SELECT QuestionName, FullMark, Mark FROM questions As q, results As r WHERE r.StudentID = (SELECT t.StudentID FROM takes As t WHERE 
                    t.StudentID = '" . $_SESSION['username'] . "' AND t.CourseID=$courseID) 
                    AND q.QuestionID = r.QuestionID ";
                      
            $result = mysql_query($query);
            print("<table border=0 width=800>\n");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=40%>");
                print("QuestionName : ");
                print("$row[QuestionName] ");
                print("</td><td width=20%>");
                print("FullMark : ");
                print("$row[FullMark]");
                print("</td><td width=20%>");
                print("YourMark : ");
                print("$row[Mark]");
                print("</td>");
            }
            print("</table>");


        } 
        
    } else {
        
        if (htmlspecialchars($_GET['q'] == "GetCourses")){
            print(" You are not authorised to view this course as you have not registered for this course. Please see the administrator for details.");
        }

    }
?>