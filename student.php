<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
    $redirect_pauseTime = 0;
    session_start();
    if(empty($_SESSION['username'])){
        print("<meta http-equiv=\"REFRESH\" content=\"". $redirect_pauseTime . ";url=login.html?notLoggedIn=1\">");
    } else {
        
        $loginDb = "assignments_uiuc";
        mysql_select_db($loginDb) or die("Can not connect to login table." . mysql_error());

        if (htmlspecialchars($_GET["q"]) == "GetAssessments"){
            $assignmentsQuery = "SELECT AssnName, AssnID FROM assignment, course WHERE 
                assignment.CourseID = course.CourseID AND
                course.CourseID = ANY (
                SELECT t.CourseID FROM takes As t, student WHERE 
                    student.StudentID = '" . $_SESSION['username'] . "' AND
                    t.StudentID = student.StudentID) AND
                DueTime < DATE_ADD( NOW( ) , INTERVAL 7 DAY)";
            $result = mysql_query($assignmentsQuery);
            if (mysql_errno()) print(mysql_error());
            print("Assignments Due this week:\n");
            print("<br><br>\n");
     
            while ($row = mysql_fetch_array($result)){
                print("<a href=\"stu_assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>". "<br>");
            }
            $todays_date= date("Y-m-d");
            $assignmentsQuery2 = "SELECT AssnName, AssnID FROM assignment, course WHERE 
                assignment.CourseID = course.CourseID AND
                course.CourseID = ANY (
                SELECT t.CourseID FROM takes As t, student WHERE 
                    student.StudentID = '" . $_SESSION['username'] . "' AND
                    t.StudentID = student.StudentID) AND
                DueTime >= $todays_date";
                    
            $result1 = mysql_query($assignmentsQuery2);
            if (mysql_errno()) print(mysql_error());
            print("<br><br>\n");
            print("All Assignments Due:\n");
            print("<br><br>\n");
     
            while ($row2 = mysql_fetch_array($result1)){
                print("<a href=\"stu_assignment.html?AssnID=$row2[AssnID]\">$row2[AssnName]</a>". "<br>");
            }
                     
            
        } else if (htmlspecialchars($_GET["q"]) == "GetCourses"){
            $coursesQuery = "SELECT CourseName, t.CourseID FROM course As c, takes As t WHERE t.StudentID = '". $_SESSION['username'] . "' AND c.CourseID = t.CourseID";
            $result = mysql_query($coursesQuery);
            print("Courses Details\n");
            print("<br><br>");       
            while ($row = mysql_fetch_array($result)){
                print("<a href=\"stu_course.html?CourseID=$row[CourseID]\">$row[CourseName]</a>" . "<br>");
            }
      
        }

    }
   

   //print("Username:" . $_SESSION['username']);
    
    
?>