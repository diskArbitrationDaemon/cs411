<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');

    
	//likewise here
    //session_start();
    $courseID= htmlspecialchars($_GET['CourseID']);

      //check to see if this student actually takes this course. If not, error is displayed.

    $query = "SELECT * FROM takes as t, student as s WHERE t.StudentID = s.StudentID AND t.StudentID='".$_SESSION['username'] ."' AND t.CourseID='$courseID'";
    $result = mysql_query($query);

    $row = mysql_fetch_array($result);
   
    if (!empty($row['CourseID'])) {

        if (htmlspecialchars($_GET['q'] == "GetCourses")){
            $query = "SELECT * FROM $courseTable WHERE CourseID = $courseID";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            if (!empty($row['CourseName'])){
                print ("<h3>".$row['CourseName']." ".$row['SemesterName']."</h3>");
                print ("There are ".$row['NumStudents']." students enrolled.<br>\n");
            } else {
                print "<h3> Invalid course selected. </h3>";
            }

        } else  if (htmlspecialchars($_GET['q'] == "GetAssignments")){
            
            $assignmentsQuery2 = "SELECT DISTINCT AssnName, AssnID FROM assignment, course WHERE 
                assignment.CourseID = $courseID AND
                DueTime >= NOW()";
                    
            $result1 = mysql_query($assignmentsQuery2);
            if (mysql_errno()) print(mysql_error());
            print("All Assignments Due:\n");
            print("<br><br>\n");
     
            while ($row2 = mysql_fetch_array($result1)){
                print("<a href=\"stu_assignment.html?AssnID=$row2[AssnID]\">$row2[AssnName]</a>". "<br>");
            }
                     
            $assignmentsQuery2 = "SELECT DISTINCT AssnName, AssnID FROM assignment, course WHERE 
                assignment.CourseID = $courseID AND
                DueTime < NOW()";
                    
            $result1 = mysql_query($assignmentsQuery2);
            if (mysql_errno()) print(mysql_error());
            print("<br><br>\n");
            print("Previous Assignments:\n");
            print("<br><br>\n");
     
            while ($row2 = mysql_fetch_array($result1)){
                print("<a href=\"stu_pre_assn.html?AssnID=$row2[AssnID]\">$row2[AssnName]</a>". "<br>");
            }
                     
                     
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

			$query = "SELECT * FROM takes as t WHERE t.StudentID='".$_SESSION['username'] ."' AND t.CourseID='$courseID'";
                      
            $result = mysql_query($query);       
            print("<table border=0 width=800>\n");
            while ($row = mysql_fetch_array($result)){
                print("<tr><td width=40%>");
                print("Course Final Grade: $row[FinalMark] ");
                print("<tr></td>");
            }
            print("</table>");
        } 
        
    } else {
        
        if (htmlspecialchars($_GET['q'] == "GetCourses")){
            print(" You are not authorised to view this course as you have not registered for this course. Please see the administrator for details.");
        }

    }
?>