<?php
    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
    $redirect_pauseTime = 0;
    session_start();
    if(empty($_SESSION['username'])){
        print("<meta http-equiv=\"REFRESH\" content=\"". $redirect_pauseTime . ";url=login.html?notLoggedIn=1\">");
    } else {
        
        $loginDb = "assignments_uiuc";
        mysql_select_db($loginDb) or die("Can not connect to login table." . mysql_error());

        if (htmlspecialchars($_GET["q"]) == "GetAssessments"){
            $assignmentsQuery = "SELECT AssnName, AssnID FROM Assignment, Course WHERE 
                Assignment.CourseID = Course.CourseID AND
                Course.CourseID = ANY (
                SELECT CourseID FROM Teaches, Instructor WHERE 
                    Instructor.NetID = '" . $_SESSION['username'] . "' AND
                    Teaches.NetID = Instructor.NetID) AND
                DueTime < DATE_ADD( NOW( ) , INTERVAL 7 DAY)";
            $result = mysql_query($assignmentsQuery);
            if (mysql_errno()) print(mysql_error());
            print("Assignments Due this week:\n");
            print("<br><br>\n");
     
            while ($row = mysql_fetch_array($result)){
                print("<a href=\"assignment.html?AssnID=$row[AssnID]\">$row[AssnName]</a>". "<br>");
            }
        } else if (htmlspecialchars($_GET["q"]) == "GetCourses"){
            $coursesQuery = "SELECT CourseName, t.CourseID FROM Course As c, Teaches As t WHERE c.CourseID = t.CourseID AND t.NetID = '". $_SESSION['username'] . "'";
            $result = mysql_query($coursesQuery);
            print("Courses you administer\n");
            print("<br><br>");       
            while ($row = mysql_fetch_array($result)){
                print("<a href=\"course.html?CourseID=$row[CourseID]\">$row[CourseName]</a>" . "<br>");
            }
      
        }


    }
   

   //print("Username:" . $_SESSION['username']);
    
    
?>
