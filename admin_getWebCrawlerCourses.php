<?php

include 'includes/mysqlAdminLoginAssignment.php';

$semesterName=$_GET["SemesterName"];


$handle = @fopen("parserApp/UIUCcourses_".$semesterName.".txt", "r");
if ($handle)
{
	while (($buffer = fgets($handle, 4096)) != false)
	{
		// Remove file specific characters (new line char, etc...)
		$buffer = substr($buffer, 0, strlen($buffer)-2);
			
		$query = "SELECT * FROM course WHERE CourseName = '$buffer' AND SemesterName = '$semesterName'";
		$result = mysql_query($query) or die(mysql_error());
		if($row = mysql_fetch_array($result)) //if we did return a record
			continue;
		
		// Get largest courseID
		$query = "SELECT MAX(courseID) FROM course";
		$result = mysql_query($query) or die(mysql_error());;
	
		while($row = mysql_fetch_array($result))
		{
			$newID = $row['MAX(courseID)'] + 1;  // newID = MAX(courseID) + 1
		}
			
		$query = "INSERT INTO course (CourseID, CourseName, SemesterName) VALUES ('$newID', '$buffer', '$semesterName')";
		
		if (!mysql_query($query, $mysqlConnection))
		{
			die ('Error: ' . mysql_error());
		}
	}
	if (!feof($handle))
	{
		echo "ERROR: unexpected fgets() fail\n";
	}
	fclose($handle);
}

mysql_close($mysqlConnection);


?>