<?php
    include ('includes/mysqlInstrLogin.php');
    include ('includes/auth.php');
    session_start();

    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
    i.InstructorID='$_SESSION[username]' AND
    t.InstructorID=i.InstructorID AND
    a.CourseID=c.courseID AND
    t.courseID=c.courseID";
    $result = mysql_query($query);
    if (mysql_errno()) die(mysql_error());
    $row = mysql_fetch_array($result);
    if(!empty($row['AssnID'])){
        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            $query = "SELECT AssnName FROM Assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) die(mysql_error());
            $row = mysql_fetch_array($result);
            $assnName = $row['AssnName'];

            $query = "SELECT CourseName FROM Course, Assignment Where AssnID=".htmlspecialchars($_GET['AssnID']) . " AND 
            Assignment.CourseID=Course.CourseID";
            $result = mysql_query($query);
            if (mysql_errno()) die(mysql_error());
            $row = mysql_fetch_array($result);
            $courseName = $row['CourseName'];

            $query = "SELECT * FROM Assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) die(mysql_error());
            $row = mysql_fetch_array($result); 
            print("<table border=0 width=400>");
            print("<tr><td height=50>$assnName - $courseName</td></tr>");
            print("<tr><td>");
                print("<table border=0>");
                    print("<tr><td height=30 width=150>Maximum Mark:</td><td>$row[MaxMark]</td></tr>");
                    print("<tr><td height=30 width=150>Median Mark: </td><td>$row[MedianMark]</td></tr>");
                    print("<tr><td height=30 width=150>Average Mark: </td><td>$row[AvgMark]</td></tr>");
                    print("<tr><td height=30 width=150><a href=\"instr_viewSubmissions.html?AssnID=$_GET[AssnID]\">View Submissions</a></td><td></td></tr>");
                print("</table>");
            print("</td></tr>");
            print("</table>");
        } else if (htmlspecialchars($_GET['q'] == "GetQuestions")){
            $query = "SELECT * FROM Questions WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) die(mysql_error());
            print("<table width=800 border=0>");
            while ($row = mysql_fetch_array($result)){

                print("<tr><td width=200 height=35>");
                print("$row[QuestionName]");
                print("</td><td>");
                print("$row[FullMark]");
                print("</td></tr>");
            }

            print("</table>");
        } else {
            print("OHSHIT");
        }
    } else {

        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            print("You are not authorised to view this assignment. Please contact the database administrator");
        }
    }
    
?>
