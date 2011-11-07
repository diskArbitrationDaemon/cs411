<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');
    session_start();

    $query = "SELECT * FROM assignment as a, course as c, takes as t, student as s WHERE
    s.StudentID='$_SESSION[username]' AND
    t.StudentID=s.StudentID AND
    a.CourseID=c.CourseID AND
    t.CourseID=c.CourseID";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    $row = mysql_fetch_array($result);
    if(!empty($row['AssnID'])){
        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            $query = "SELECT AssnName FROM assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result);
            $assnName = $row['AssnName'];

            $query = "SELECT CourseName FROM course, assignment Where AssnID=".htmlspecialchars($_GET['AssnID']) . " AND 
            assignment.CourseID=course.CourseID";
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result);
            $courseName = $row['CourseName'];

            $query = "SELECT * FROM assignment WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            $row = mysql_fetch_array($result); 
            print("<table border=0 width=400>");
            print("<tr><td height=50>$assnName - $courseName</td></tr>");
            print("<tr><td>");
                print("<table border=0>");
                    print("<tr><td height=30 width=150>Maximum Mark:</td><td>$row[MaxMark]</td></tr>");
                print("</table>");
            print("</td></tr>");
            print("</table>");
        } else if (htmlspecialchars($_GET['q'] == "GetQuestions")){
            $query = "SELECT * FROM questions WHERE AssnID=" . htmlspecialchars($_GET['AssnID']);
            $result = mysql_query($query);
            if (mysql_errno()) print(mysql_error());
            print("<table width=800 border=0>");
            while ($row = mysql_fetch_array($result)){

                print("<tr><td width=200 height=35>");
                print("<a href=\"stu_assn_sub.html?QeustionID=$row[QuestionID]\">$row[QuestionName]</a>");
                print("</td><td>");
                print("$row[FullMark]");
                print("</td></tr>");
            }

            print("</table>");
        } 
    } else {

        if (htmlspecialchars($_GET['q'] == "GetAssessments")){
            print("You are not authorised to view this assignment. Please contact the database administrator");
        }
    }
    
?>