<?php
    include ('includes/mysqlInstrLogin.php');
    session_start();
    $loginDb = "assignments_uiuc";
    mysql_select_db($loginDb) or die("Can not connect to login table." . mysql_error());
    $coursesForThisInstructorQuery = "SELECT CourseName FROM Course As c, Teaches As t WHERE c.CourseID = t.Course AND t.Instructor = '". $_SESSION['username'] . "'";
    $result = mysql_query($coursesForThisInstructorQuery);
    $resultsInArray = mysql_fetch_assoc($result);
    print_r($resultsInArray); 
    //print("Username:" . $_SESSION['username']);
    
    
?>
