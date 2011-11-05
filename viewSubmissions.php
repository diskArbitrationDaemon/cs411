<?php

    include('includes/auth.php');
    include('includes/mysqlInstrLogin.php');

    $query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
        i.InstructorID='$_SESSION[username]' AND
        t.InstructorID=i.InstructorID AND
        a.CourseID=c.courseID AND
        t.courseID=c.courseID";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    
    if (mysql_num_rows($result)){
        $assnID = $_GET['AssnID'];
       
        $query = "SELECT AssnName FROM Assignment WHERE AssnID=$assnID";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        $assnName = $row['AssnName'];
        $query = "SELECT StudentID FROM Submission WHERE AssnID=$assnID";
        $result = mysql_query($query);
        if (mysql_errno() > 0) print("Mysql error: " . mysql_error());
        
        print("Submissions for <a href=\"assignment.html?AssnID=$assnID\">$assnName</a><br><br>");
        while($row = mysql_fetch_array($result)){

            print "<a href=\"mark.html?AssnID=$_GET[AssnID]&StudentID=$row[StudentID]\">$row[StudentID]</a><br>";
            print("\n<br>\n");
        }
    } else {
        print ("Not authorized.");
        
    }
    
?>
