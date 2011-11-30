<?php

include ('includes/mysqlInstrLogin.php');
include ('includes/auth.php');

if (empty($_POST['stage'])){
	
    //GET vars required:

	//checks if instructor has access
	$query = "SELECT * FROM Assignment as a, Course as c, Teaches as t, Instructor as i WHERE
        i.InstructorID='$_SESSION[username]' AND
        t.InstructorID=i.InstructorID AND
        a.CourseID=c.courseID AND
        t.courseID=c.courseID";
    $result = mysql_query($query);
    if (mysql_errno()) print(mysql_error());
    if(mysql_num_rows($result)){

        //get questions
        $query = "SELECT Course.CourseID, CourseName, Assignment.AssnID, AssnName, QuestionName, Questions.QuestionID FROM Questions, Assignment, Course, Takes, Teaches WHERE
        Takes.CourseID = Course.CourseID AND
        Takes.StudentID = '".htmlspecialchars($_GET['StudentID'])."' AND
        Course.CourseID = '".$_GET['CourseID']."' AND
        Assignment.CourseID = Course.CourseID AND
        Questions.AssnID = Assignment.AssnID AND
        Teaches.CourseID = Course.CourseID AND
        Teaches.InstructorID = '" . $_SESSION['username'] ."'";
        		
        $courseID = $_GET['CourseID'];

        $result = mysql_query($query);
        if (mysql_errno()) print(mysql_error());
        if (mysql_num_rows($result) == 0){
            print ("There are no records available for you to view.");
        } else {
            print("<table border=0 width=900>\n");
            $i = 0;
            $row = mysql_fetch_array($result);
            $assnName = $row['AssnName'];
            $assnID = $row['AssnID'];
            $courseName = $row['CourseName'];
            mysql_data_seek($result, 0);
            while ($row = mysql_fetch_array($result)){
				
                $markquery = "SELECT Mark FROM Results WHERE StudentID='".$_GET['StudentID']."' AND QuestionID='".$row['QuestionID']."'";
                $markQueryResult = mysql_query($markquery);
                $mark = "";
                if (mysql_num_rows($markQueryResult)){
                    $markRow = mysql_fetch_array($markQueryResult);
                    $mark = $markRow['Mark'];
                }
                if ($assnID != $row['AssnID']){
                	$assnQuery = "SELECT AssnFinalMark FROM Submission WHERE AssnID=$assnID AND StudentID='".$_GET['StudentID']."'";
                	$assnResult = mysql_query($assnQuery);
                	$assnRow = mysql_fetch_array($assnResult);
                	$assnFinalMark = $assnRow['AssnFinalMark'];
                	print("<tr><td width=200> $assnName </td><td width=300> Assignment Total </td><td><input type=text name=Assn[$assnID] length=5 value=\"$assnFinalMark\"></td></tr>\n");
                	print("<tr><td height=10></td></tr>");
                	$assnName = $row['AssnName'];
                	$assnID = $row['AssnID'];
                }

                print("<tr><td width=200> $row[QuestionName] </td><td width=300></td><td><input type=text name=Question[$row[QuestionID]]" ." length=5 value=\"".$mark."\"></td></tr>\n");
            }
            
            //get finalmark for this assignment
            $assnQuery = "SELECT AssnFinalMark FROM Submission WHERE AssnID=$assnID AND StudentID='".$_GET['StudentID']."'";
            $assnResult = mysql_query($assnQuery);
            if (mysql_errno()) die ("Cannot find assignment marks" . mysql_error());
            $assnRow = mysql_fetch_array($assnResult);
            $assnFinalMark = $assnRow['AssnFinalMark'];
            print("<tr><td width=200> $assnName </td><td width=300> Assignment Total </td><td><input type=text name=Assn[$assnID] length=5 value=\"$assnFinalMark\"></td></tr>\n");
            print("<tr><td height=10></td></tr>");
            $finalMarkQuery = "SELECT FinalMark FROM takes WHERE StudentID='".$_GET['StudentID']."' AND CourseID=$courseID";
            $finalMarkRes = mysql_query($finalMarkQuery);
            $finalMarkRow = mysql_fetch_array($finalMarkRes);
            print("<tr><td width=200> Course Grade: </td><td width=300></td><td><input type=text name=finalMark length=5 value=\"$finalMarkRow[FinalMark]\"></td></tr>\n");
			
            print("<tr><td height=10></td></tr>");
            print("<input type=hidden name=stage value=1>\n");
            print("<input type=hidden name=courseID value=".$courseID.">");
            print("<input type=hidden name=student value=".$_GET['StudentID'].">\n");
            print("<input type=hidden name=assnID value=".$assnID.">\n");
            //print ("assnID: $assnID courseID: $courseID");
            print("<tr><td><input type=\"submit\"  value=\"Save Grades\"></td><td></td></tr>\n");
            print("</table>\n");

        }
    } else {
        die("You do not have permission to access this page");
    }
} else if ($_POST['stage'] == 1){
    $studentID = $_POST['student'];
    foreach ($_POST['Question'] as $key => $value){ 
		
    	$query = "INSERT into Results VALUES ('$studentID', '$key', '$value')

        ON DUPLICATE KEY UPDATE mark='$value'";
        if (!empty($value)) mysql_query($query);
        
        if (mysql_errno() > 0) die("error: " . mysql_error() . "<br> Query: " . $query);
    }
    foreach ($_POST['Assn'] as $assnID => $assnMark){
		$query = "UPDATE Submission SET AssnFinalMark='$assnMark' WHERE StudentID='$studentID' AND AssnID='$assnID'";
	    print $query ."<br><br>";
	    mysql_query($query);
	    if (mysql_errno() > 0) die("error: " . mysql_error() . "<br> Query: " . $query);
    }
    //$assnID = $_POST['assnID'];
    //print("AssnMark: ".$_POST['assnMark']);
    
    
    $finalMark = $_POST['finalMark'];
    $courseID = $_POST['courseID'];
    $query = "UPDATE takes SET FinalMark='$finalMark' WHERE StudentID='$studentID' AND CourseID='$courseID'";
    print $query ."<br><br>";
    mysql_query($query);
    if (mysql_errno() > 0) die("error: " . mysql_error() . "<br> Query: " . $query);
    print("Results saved!\n");
    
    print("<meta http-equiv=\"REFRESH\" content=\"2;url=instr_mark.html?StudentID=$studentID&CourseID=$courseID\">");
}
?>
