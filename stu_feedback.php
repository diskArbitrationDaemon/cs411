<?php
    include ('includes/mysqlstudentLogin.php');
    include ('includes/auth.php');

    

    session_start();
  
    if (htmlspecialchars($_GET['q'] == "GetFeedback"))
    {
		$StudentID=$_SESSION[username];
   		$assnid=htmlspecialchars($_GET['AssnID']);
   	
   	
   		$query2 = "SELECT AssnName, CourseID FROM assignment as a WHERE a.AssnID = $assnid ";
    	$result2 = mysql_query($query2);

	    $row2 = mysql_fetch_array($result2);
   		$assnname=$row2['AssnName'];
   		$courseid=$row2['CourseID'];  	
   	
   		$query3 = "SELECT CourseName, SemesterName FROM course as c WHERE c.CourseID = $courseid ";
    	$result3 = mysql_query($query3);

	    $row3 = mysql_fetch_array($result3);
    	$coursename=$row3['CourseName'];
	   	$semester=$row3['SemesterName'];
   	
   		print("<br><br>\n");
   		$file = fopen("Submissions/$semester/$coursename/$assnname/$StudentID/Feedback.txt", "r") or exit("No Comments available!");
		print("<br><br>\n");
		if($file)
		{
		
			while(!feof($file))
  			{
  				echo fgets($file). "<br />";
  			}
			fclose($file);
		}
	}
   	
?>
